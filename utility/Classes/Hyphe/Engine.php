<?php
/** @noinspection All */
namespace Hyphe;

use Masterminds\HTML5;
use Moorexa\Tag;

/**
 *@author Ifeanyi Amadi https://amadiify.com/
 *@version 1.0
 *@package Hyphe engine class
*/

class Engine
{
    public  static $propsInit;
    private $caller = [];
    public $dir = null;
    private $mask = [];
    private static $instances = null;
    private static $dom = null;
    public  static $variables = [];
    private static $chsInstances = [];
    public  $interpolateContent = null;
    private $cachedOutput = null;
    private $cachedFiles = [];
    private static $cachedArray = [];
    private $styles = [];
    public $interpolateString = true;
    public $interpolateExternal = null;
    private static $hypheList = [];

    // self closing tags
    public $selfClosing = [
        'img',
        'meta',
        'link',
        'hr',
        'source',
        'area',
        'base',
        'br',
        'col',
        'embed',
        'input',
        'param',
        'track',
        'wbr'
    ];

    public static function ParseTags(string $doc, $directive = '')
    {
        $directive = strlen($directive) == 0 ? Compile::$rootDir : $directive;

        if (!is_dir($directive))
        {
            // create directory
            mkdir($directive);
        }

        if (count(self::$hypheList) == 0)
        {
            // load all
            $files = self::getAllFiles($directive);
            $files = self::reduce_array($files);

            foreach($files as $index => $file)
            {
                $base = basename($file);
                $base = substr($base, 0, strpos($base, '.'));

                if (!isset(self::$hypheList[$base]) && $base != '')
                {
                    self::$hypheList[$base] = $file;
                }
            }
        }

        $obj = new Engine();
        $obj->dir = $directive;

        $document = $obj->loadComponent(trim($doc));

        $document = str_replace('<?=', '', $document);
        $document = str_replace('?>', '', $document);

        return $document;
        
    }

    private function hasRequired($name)
    {
        switch ($name)
        {
            case 'assets':
                if (class_exists('\Moorexa\Assets'))
                {
                    return true;
                }
            break;

            case 'rexa':
                if (class_exists('\Moorexa\Rexa'))
                {
                    return true;
                }
            break;

            case 'bootloader':
                if (class_exists('\Moorexa\Bootloader'))
                {
                    return true;
                }
            break;
        }

        return false;
    }

    // load assets if on moorexa
    protected function loadAssets()
    {
        if (class_exists('\Moorexa\Assets'))
        {
            return boot()->get('\Moorexa\Assets');
        }
    }

    public function getAttributes(string $attributeString)
    {
        static $html;

        if (is_null($html))
        {
            $html = new HTML5();
        }

        // build element
        $document = '<section id="check-attributes" '.$attributeString . '</section>';

        // load document
        $load = $html->loadHTML($document);
        
        // get element
        $element = $load->getElementById('check-attributes');

        $attributes = [];

        foreach($element->attributes as $attribute)
        {
            if ($attribute->value != 'check-attributes')
            {
                $attributes[$attribute->name] = $attribute->value;
            }
        }

        return $attributes;
    }

    // read self closing directive
    private function readSelfClosingDirectives(string $tag, string &$document, string &$domDocument)
    {
        $directives = [];

        // get tags in doc
        $tagQuote = preg_quote($tag, '/');
        preg_match_all("/(<$tagQuote([\s\S]*?>))/", $document, $matches);

        if (count($matches) > 0)
        {
            foreach ($matches[0] as $index => $outerHTML)
            {
                // get ending
                $ending = trim($outerHTML);

                if (substr($ending, -2) == '/>')
                {
                    $position = strpos($domDocument, $outerHTML);

                    if ($position !== false)
                    {
                        $hash = md5(($position + $index) . $outerHTML . time() * 10);

                        $directives[] = [
                            'outerHTML' => $outerHTML,
                            'attributeString' => $matches[2][$index],
                            'innerHTML' => '',
                            'hash' => $hash,
                            'position' => $position
                        ];

                        $domDocument = substr_replace($domDocument, $hash, $position, strlen($outerHTML));
                    }
                }
            }
        }

        return $directives;
        
    }

    // read directives with closing tags
    private function readDirectivesWithClosingTags(string $tag, string &$document, string &$domDocument)
    {
        $directives = [];

        // get tags in doc
        $tagQuote = preg_quote($tag, '/');
        preg_match_all("/(<$tagQuote([\s\S]*?>))+([\s\S]+?)(<\/$tagQuote>)/", $document, $matches);

        if (count($matches) > 0)
        {
            foreach ($matches[0] as $index => $outerHTML)
            {
                $position = strpos($domDocument, $outerHTML);

                if ($position !== false)
                {
                    $hash = md5(($position + $index) . $outerHTML . time() * 60);

                    $directives[] = [
                        'outerHTML' => $outerHTML,
                        'attributeString' => $matches[2][$index],
                        'innerHTML' => $matches[3][$index],
                        'hash' => $hash,
                        'position' => $position
                    ];

                    $domDocument = substr_replace($domDocument, $hash, $position, strlen($outerHTML));
                }
            }
        }

        return $directives;
        
    }

    // load injector
    private function loadInjector(array &$props, string &$document)
    {
        $injector = $props['inject'];
        $injectorList = explode(',', $injector);

        $props['inject'] = []; // create a new array

        foreach ($injectorList as $tagName)
        {
            // remove whitespace
            $tagName = trim($tagName);

            // find tag inside document
            preg_match("/(<$tagName>)([\s\S]+?)(<\/$tagName>)/", $document, $target);

            if (isset($target[2]))
            {
                $props['inject'][$tagName] = $target[2];
                // now remove target from document
                $document = str_replace($target[0], '', $document);
            }
        }
    }

    private function loadComponent($doc, $inner = null)
    {
        $doc = "  $doc";
        static $hasScript;
        static $html;

        if ($hasScript == null)
        {
            $hasScript = [];
        }

        $this->removeStyle($doc);

        $script = strstr($doc, "<script");

        if ($script !== false)
        {
            preg_match_all('/(<script)\s*(.*?)>/', $script, $s);

            if (count($s[0]) > 0)
            {
                $_script = $s[0];
                array_walk($_script, function($x) use (&$doc, &$script, &$hasScript){
                    $tag = $x;
                    $block = $this->getblock($script, $tag, 'script');
                    $strip = trim(strip_tags($block));
                    if (strlen($strip) > 3)
                    {
                        $hash = md5($block);
                        $hasScript[$hash] = $block;
                        $doc = str_replace($block, $hash, $doc);
                    }
                });

                // clean up
                $_script = null;
            }
        }

        //  check if we have tags
        $tags = [];
        $tree = [];

        $copy = $doc;

        if (is_null($html))
        {
            $html = new HTML5();
        }

        // check body
        $checkDomBody = false;

        // load components 
        foreach(self::$hypheList as $tag => $fileName)
        {
            $hasTag = strstr($doc, "<{$tag}");
            
            if ($hasTag !== false)
            {
                // get tags in doc
                $directives = $this->readSelfClosingDirectives($tag, $hasTag, $doc);
                $directives = array_merge($directives, $this->readDirectivesWithClosingTags($tag, $hasTag, $doc));

                if (count($directives) > 0)
                {
                    foreach ($directives as $directive)
                    {
                        $innerHTML = $directive['innerHTML'];
                        $outerHTML = $directive['outerHTML'];

                        // read attributes 
                        $attributeString = $directive['attributeString'];

                        // get attributes
                        $props = $this->getAttributes($attributeString);

                        if (isset($props['namespace']) || isset($props['directive']))
                        {
                            $dir = isset($props['directive']) ? $props['directive'] : $this->dir;
                            $namespace = isset($props['namespace']) ? $props['namespace'] : null;
                            
                            $scan = Compile::deepScan($dir. '/' . $namespace, $tag . '.html');
                            
                            if ($scan != null)
                            {
                                // compile file
                                $file = Compile::compileFile($scan, $namespace);
                            }
                        }
                        else
                        {
                            // compile file
                            $file = Compile::compileFile($fileName, null, $this->dir);
                        }

                        if (isset($props['inject']))
                        {
                            $this->loadInjector($props, $innerHTML);
                        }

                        
                        $block = $outerHTML;
                        $exportparts = [];
                        $excludeparts = [];

                        $data = $this->getComponentData($file, $tag, $block, $props, $exportparts, $excludeparts);
                            
                        $tree[$directive['position']] = [
                            'inner' => $innerHTML,
                            'block' => $block,
                            'tag' => $tag,
                            'data' => $data,
                            'hash' => $directive['hash'],
                            'exportparts' => $exportparts,
                            'excludeparts' => $excludeparts
                        ];
                    }

                    // check again
                    $checkDomBody = true;
                }
            }
        }
        
        $doc = trim($doc);

        ksort($tree);

        foreach ($tree as $branch)
        {
            // extract data
            extract($branch);

            // replace props children
            if (strpos($data, '(--inner-child-dom--)') !== false)
            {
                // next inner here
                $data = str_replace("(--inner-child-dom--)", $inner, $data);
            }

            if ($data != null)
            {
                // replace block with data
                $block = str_replace($block, $data, $block);

                // replace hash
                $doc = str_replace($hash, $block, $doc);

                // replace export parts
                if (count($exportparts) > 0)
                {
                    foreach ($exportparts as $part => $element)
                    {
                        $doc = str_replace($element['outer'], '', $doc);
                        $doc = str_replace($part, $element['inner'], $doc);
                    }
                }

                // replace exclude parts
                if (count($excludeparts) > 0)
                {
                    foreach ($excludeparts as $element)
                    {
                        $doc = str_replace($element['outer'], '', $doc);
                    }
                }
            }
        }
        
        $wrapper = $doc;
        $wrapper = preg_replace('/(<php-var>)([^<]+)(<\/php-var>)/', '', $wrapper);

        foreach (self::$hypheList as $tag => $file)
        {
            $hasTag = strstr($wrapper, "<{$tag}");
            
            if ($hasTag !== false && $checkDomBody)
            {
                $tagQuote = preg_quote($tag, '/');
                preg_match_all("/((<$tagQuote(.*?>))+([\s\S]+?)(<\/$tagQuote>))|((<$tagQuote(.*?\/>)))/", $hasTag, $matches);

                if (count($matches[0]) > 0)
                {
                    $wrapper = $this->loadComponent($wrapper);
                    break;
                }
            }
        }

        if ($hasScript !== null)
        {
            if (is_array($hasScript) && count($hasScript) > 0)
            {
                foreach($hasScript as $hash => $block)
                {
                    $wrapper = str_replace($hash, $block, $wrapper);
                }
            }
        }

        return $wrapper;
        
    }

    private function getComponentData($file, $tag, $block, $props, &$exportparts, &$excludeparts)
    {
        $continue = false;
        $render = null;
        $lower = strtolower($tag);
        $props = (object) $props;
        $data = null;

        if (count($this->mask) > 0)
        {
            foreach($props as $key => $val)
            {
                $_key = $tag . '/' . $key;
                if (isset($this->mask[$_key]))
                {
                    $props->{$key} = $this->mask[$_key];
                }
            }
        }

        $obj = (object)[];
        $obj->props = $props;

        $chs = null;
        $all_vars = [];

        if (file_exists($file))
        {
            include_once $file;

            $className = $tag;

            if (isset($props->namespace))
            {
                $className = $props->namespace .'\\' . $tag;
            }
            else
            {
                // read hyphe paths
                $json = read_json(__DIR__ . '/hyphe.paths.json', true);

                // get path base name
                $basname = basename($file);

                if (isset($json[$basname]))
                {
                    $className = $json[$basname] . '\\' . $className;
                }
            }

            if ( class_exists ($className))
            {
                $props = $obj->props;
                $continue = true;

                $var = (object)[];

                if ($this->hasRequired('bootloader'))
                {
                    $vars = \Moorexa\Controller::$dropbox;

                    foreach ($vars as $key => $v)
                    {
                        $var->{$key} = $v;
                    }
                }

                $chs = new $className($props, $var);
                $ref = null;
                                        
                $chs->props = $props;
                $chs->props->children = '(--inner-child-dom--)';
                $chs->var = $var;
                $this->caller[] = $chs;

                $data = null;

                if (method_exists($chs, 'render'))
                {
                    ob_start();
                    $const = [];

                    if ($this->hasRequired('boot'))
                    {
                        \Moorexa\Bootloader::$instance->getParameters($chs, 'render', $const, [$props]);
                    }

                    $render = call_user_func_array([$chs, 'render'], $const);
                    $data = ob_get_contents();
                    ob_clean();
                }

                
                // export part
                $this->loadExportParts($props, $data, $exportparts);
                
                // exclude part
                $this->loadExcludeParts($props, $data, $excludeparts);

            }
        }
        

        return $data;
    }

    // load export parts
    private function loadExportParts($props, $data, &$exportparts)
    {
        if (isset($props->exportparts))
        {   
            $parts = explode(',', $props->exportparts);

            foreach ($parts as $part)
            {
                if (preg_match("/(\s*)(<$part(.*?)>)([\s\S]+?)(<\/$part>)/i", $data, $match))
                {
                    $exportparts['exportparts.'.$part] = [
                        'inner' => $match[4],
                        'outer' => $match[0]
                    ];
                }
            }
        }
    }

    // load exclude parts
    private function loadExcludeParts($props, $data, &$excludeparts)
    {
        if (isset($props->excludeparts))
        {   
            $parts = explode(',', $props->excludeparts);

            foreach ($parts as $part)
            {
                if (preg_match("/(\s*)(<$part(.*?)>)([\s\S]+?)(<\/$part>)/i", $data, $match))
                {
                    $excludeparts[] = [
                        'outer' => $match[0]
                    ];
                }
            }
        }
    }

    // convert shortcuts
    public function convertShortcuts(&$content, $chs = null)
    {

        if ($this->hasRequired('assets'))
        {
            $assets = new \Moorexa\Assets();
        }

        if ($this->hasRequired('bootloader'))
        {
            if (isset(\Moorexa\BootLoader::$helper['a_view']))
            {
                $vw = \Moorexa\Bootloader::$helper['a_view'];
            }
            elseif (isset(\Moorexa\Bootloader::$helper['ROOT_GET']) && isset(\Moorexa\Bootloader::$helper['ROOT_GET'][1]))
            {
                $vw = \Moorexa\Bootloader::$helper['ROOT_GET'][1];
            }
        }

        if (isset($vw))
        {

            $action = function(string $path, $data = null) use ($vw)
            {
                if (is_array($data))
                {
                    $build = http_build_query($data);

                    $pa = $vw .'/'. $path .'?'. rawurlencode($build);

                    return abspath($pa);
                }
                else
                {
                    $pa = $vw .'/'. $path;
                    return abspath($pa);
                }
            };


            $this->action = $action;


            unset($vw);
        }

        if ($this->hasRequired('rexa'))
        {
            \Moorexa\Controller::$dropbox['assets'] = $assets;

            $content = &$this->interpolateContent;
            
            // load directive
            $content = \Moorexa\Rexa::loadDirective($content, $this);
        }

        
        // php-if attribute
        preg_match_all("/<\s*\w.*(php-if=)\s*\"?\s*([\w\s%#\/\.;:_-]?.*)\s*\"(\s*>|(\s*\S*?>))/", $content, $matches);
        if (count($matches) > 0 && count($matches[0]) > 0)
        {
            foreach($matches[0] as $i => $tag)
            {
                // get tag name
                preg_match('/[<]([\S]+)/', $tag, $tagName);
                $tagName = $tagName[1];
                $attribute = 'php-if';
                $attr = preg_quote($attribute, '/');

                // get quote
                preg_match("/($attr)\s*=\s*(['|\"])/",$tag, $getQuote);
                $getQuote = $getQuote[2];

                // get argument for attribute
                preg_match("/($attr)\s*=\s*([$getQuote])([\s\S]*?[$getQuote])/", $tag, $getAttr);
                $getQuote = null;
                
                $attributeDecleration = $getAttr[0];
                
                $getAttr = isset($getAttr[3]) ? $getAttr[3] : null;
                $getAttr = preg_replace('/[\'|"]$/','',$getAttr);

                $ifs = '<?php'."\n";
                $ifs .= 'if('.$getAttr.'){?>'."\n";

                // get before
                $begin = strstr($content, $tag);
                $before = $this->getblock($begin, $tag, $tagName);

                $start = strpos($before, $attributeDecleration);
                $block = substr_replace($before, '', $start, strlen($attributeDecleration));
                $block = preg_replace('/([<])([\S]+)\s{1,}[>]/', '<$2>', $block);

                $ifs .= $block;
                $ifs .= "\n<?php }\n";
                $ifs .= '?>';
                
                if (!is_null($this->interpolateContent))
                {
                    $this->interpolateContent = str_replace($before, $ifs, $this->interpolateContent);
                }
            }
        }

        $matches = null;

        // php-for attribute
        preg_match_all("/<\s*\w.*(php-for=)\s*\"?\s*([\w\s%#\/\.;:_-]?.*)\s*\"(\s*>|(\s*\S*?>))/", $content, $matches);
        if (count($matches) > 0 && count($matches[0]) > 0)
        {
            foreach($matches[0] as $i => $tag)
            {
                // get tag name
                preg_match('/[<]([\S]+)/', $tag, $tagName);
                $tagName = $tagName[1];
                $attribute = 'php-for';
                $attr = preg_quote($attribute, '/');

                // get quote
                preg_match("/($attr)\s*=\s*(['|\"])/",$tag, $getQuote);
                $getQuote = $getQuote[2];

                // get argument for attribute
                preg_match("/($attr)\s*=\s*([$getQuote])([\s\S]*?[$getQuote])/", $tag, $getAttr);
                $getQuote = null;
                
                $attributeDecleration = $getAttr[0];
                
                $getAttr = isset($getAttr[3]) ? $getAttr[3] : null;
                $getAttr = preg_replace('/[\'|"]$/','',$getAttr);

                // get before
                $begin = strstr($content, $tag);
                $before = $this->getblock($begin, $tag, $tagName);
                
                $start = strpos($before, $attributeDecleration);
                $block = substr_replace($before, '', $start, strlen($attributeDecleration));
                $block = preg_replace('/([<])([\S]+)\s{1,}[>]/', '<$2>', $block);
                
                $bind = $attribute;
                $attribute = $getAttr;
                $clear = false;

                if (strpos($attribute, ' in ') > 2)
                {
                    $statement = explode(' in ', $attribute);

                    if (count($statement) == 2)
                    {
                        $left = $statement[0];
                        $right = $statement[1];

                        $vars = '{'.$right.'}';
                        $this->stringHasVars($vars, $chs, true);

                        $val = null;
                        $key = null;

                        $exp = explode(',', $left);
                        foreach($exp as $ix => $k)
                        {
                            $exp[$ix] = trim($k);
                        }

                        if (count($exp) == 2)
                        {
                            $key = $exp[0];
                            $val = $exp[1];
                        }
                        else
                        {
                            $val = $exp[0];
                        }

                        if (is_numeric($vars))
                        {
                            $right = '$_'.time();
                            $int = intval($vars);
                            $range = range(0, $int);
                            $vars = $range;
                        }

                        $forl = '<?php'."\n";
                        $forl .= 'if (is_array('.$right.') || is_object('.$right.')){'."\n";
                        $forl .= "foreach ($right ";
                        if ($key !== null)
                        {
                            $forl .= "as $key => $val){\n";
                        }
                        else
                        {
                            $forl .= "as $val){\n";
                        }

                        $forl .= "?>\n";
                        $forl .= $block;
                        $forl .= "<?php }\n}?>";

                        if (!is_null($this->interpolateContent))
                        {
                            $this->interpolateContent = str_replace($before, $forl, $this->interpolateContent);
                        }
                    }
                }
                

            }
        }

        $matches = null;

        if ($this->hasRequired('bootloader'))
        {
            // php-while attribute
            preg_match_all("/<\s*\w.*(php-while=)\s*\"?\s*([\w\s%#\/\.;:_-]?.*)\s*\"(\s*>|(\s*\S*?>))/", $content, $matches);
            if (count($matches) > 0 && count($matches[0]) > 0)
            {
                foreach($matches[0] as $i => $tag)
                {
                    // get tag name
                    preg_match('/[<]([\S]+)/', $tag, $tagName);
                    $tagName = $tagName[1];
                    $attribute = 'php-while';
                    $attr = preg_quote($attribute, '/');

                    // get quote
                    preg_match("/($attr)\s*=\s*(['|\"])/",$tag, $getQuote);
                    $getQuote = $getQuote[2];

                    // get argument for attribute
                    preg_match("/($attr)\s*=\s*([$getQuote])([\s\S]*?[$getQuote])/", $tag, $getAttr);

                    $getQuote = null;
                    
                    $attributeDecleration = $getAttr[0];
                    
                    $getAttr = isset($getAttr[3]) ? $getAttr[3] : null;
                    $getAttr = preg_replace('/[\'|"]$/','',$getAttr);

                    // get before
                    $begin = strstr($content, $tag);
                    $before = $this->getblock($begin, $tag, $tagName);

                    $start = strpos($before, $attributeDecleration);
                    $block = substr_replace($before, '', $start, strlen($attributeDecleration));
                    $block = preg_replace('/([<])([\S]+)\s{1,}[>]/', '<$2>', $block);
                    
                    $bind = $attribute;
                    $attribute = $getAttr;
                    $clear = false;


                    if (strpos($attribute, ' is ') > 2)
                    {
                        $statement = explode(' is ', $attribute);

                        if (count($statement) == 2)
                        {
                            $left = trim($statement[0]);
                            $right = $statement[1];

                            $vars = '{'.$right.'}';
                            $dump = null;
                            $this->stringHasVars($vars, $chs, true, $dump);

                            $whilel = '<?php'."\n";
                            $whilel .= 'if (is_array('.$right.') || is_object('.$right.')){'."\n";
                            $whilel .= '\Moorexa\DBPromise::$loopid = 0;'."\n";
                            $whilel .= 'while ('.$left.' = '.$right.'){?>'."\n";
                            $whilel .= $block;
                            $whilel .= "\n<?php }\n}?>";

                            if (!is_null($this->interpolateContent))
                            {
                                $this->interpolateContent = str_replace($before, $whilel, $this->interpolateContent);
                            }
                        }
                    }
                }
            }
        }

        $matches = null;

        $binds = ['php-if::id' => 'id',
                  'php-if::class' => 'class',
                  'php-if::for' => 'for',
                  'php-if::name' => 'name',
                  'php-if::type' => 'type',
                  'php-if::placeholder' => 'placeholder',
                  'php-if::src' => 'src',
                  'php-if::href' => 'href',
                  'php-if::value' => 'value',
                  'php-if::action' => 'action',
                  'php-if::method' => 'method',
                  'php-if::style' => 'style'
                 ];
        foreach($binds as $bind => $attrib)
        {
            $qotr = preg_quote($bind);
            preg_match_all("/<\s*\w.*($qotr=)\s*\"?\s*([\w\s%#\/\.;:_-]?.*)\s*\"(\s*>|(\s*\S*?>))/", $content, $matches);

            $alltags = [];

            if (count($matches[0]) > 0)
            {
                foreach ($matches[0] as $i => $l)
                {
                    $l = trim($l);
                    if (preg_match("/[>]$/", $l))
                    {
                        $alltags[] = $l;
                    }
                    else
                    {
                        $qu = preg_quote($l, '/');
                        preg_match("/($qu)\s*\"?\s*([\w\s%#\/\.;:_-]*)\s*\"?.*>/", $content, $s);
                        if (isset($s[0]))
                        {
                            $alltags[] = $s[0];
                        }
                    }
                }
            }

            if (count($alltags) > 0)
            {
                foreach($alltags as $i => $tag)
                {
                    // get tag name
                    preg_match('/[<]([\S]+)/', $tag, $tagName);
                    $tagName = $tagName[1];
                    $attribute = $bind;
                    $attr = preg_quote($attribute, '/');

                    // get quote
                    preg_match("/($attr)\s*=\s*(['|\"])/",$tag, $getQuote);
                    $getQuote = $getQuote[2];

                    // get argument for attribute
                    preg_match("/($attr)\s*=\s*([$getQuote])([\s\S]*?[$getQuote])/", $tag, $getAttr);
                    
                    $attributeDecleration = $getAttr[0];
                    
                    $getAttr = isset($getAttr[3]) ? $getAttr[3] : null;
                    $getAttr = preg_replace('/[\'|"]$/','',$getAttr);

                    // get before
                    $quote = preg_quote($getAttr, '/');
                    $tagattr = strpos($tag, $bind.'=');
                    $beforeattr = preg_quote(substr($tag, 0, $tagattr));
                    $begin = strstr($content, $tag);
                    $before = $this->getblock($begin, $tag, $tagName);

                    $start = strpos($before, $attributeDecleration);
                    
                    $other = ' '.$attrib.'="<?=('.$getAttr.')?>"';

                    if (!is_null($this->interpolateContent))
                    {
                        $this->interpolateContent = str_replace($attributeDecleration, $other, $this->interpolateContent);
                    }
                }
            }
            
            $matches = null;
            $qotr = null;
        }

        $binds = null;

        if ($this->hasRequired('bootloader'))
        {
            if (!is_null($this->interpolateContent))
            {
                preg_match_all('/[<](a)(.*?)(hy-href|hy-action|hy-shref)\s{0,}[=][\'|"]([^\'|"]+)[\'|"]/', $this->interpolateContent, $matches);
                foreach ($matches[0] as $i => $ac)
                {
                    $href = false;
                    $href2 = false;

                    if (strstr($ac, 'hy-href') == true)
                    {
                        $ma = substr($ac, strpos($ac, 'hy-href'));
                        $href = true;
                    }
                    elseif (strstr($ac, 'hy-shref') == true)
                    {
                        $ma = substr($ac, strpos($ac, 'hy-shref'));
                        $href2 = true;
                    }
                    elseif (strstr($ac, 'hy-action') == true)
                    {
                        $ma = substr($ac, strpos($ac, 'hy-action'));
                    }


                    $replace = $ac;

                    $eq = substr($ma, strpos($ma, '=')+1);
                    $eq = preg_replace('/[\'|"]/', '', $eq);

                    $eq = rtrim($eq, '/');
                    $eq = ltrim($eq, '/');
                    $other = null;

                    $eq = preg_replace("/[{]|[}]/", '', $eq);

                    $eq = '"'.$eq.'"';

                    if ($href)
                    {
                        $other = 'href="<?=url('.$eq.')?>"';
                    }
                    elseif ($href2)
                    {
                        $other = 'href="<?=url('.$eq.',true)?>"';
                    }
                    else
                    {
                        $other = 'href="<?=action('.$eq.')?>"';
                    }
                    
                    $_ac = str_replace($ma, $other, $ac);
                    $this->interpolateContent = str_replace($replace, $_ac, $this->interpolateContent);
                }

            }
            
            $matches = null;

            if (!is_null($this->interpolateContent))
            {
                preg_match_all('/[<](img)(.*?)(hy-src)\s{0,}[=][\'|"]([^\'|"]+)[\'|"]/', $this->interpolateContent, $matches);

                foreach ($matches[0] as $i => $ac)
                {
                    
                    $ma = substr($ac, strpos($ac, 'hy-src'));

                    $replace = $ac;


                    $eq = substr($ma, strpos($ma, '=')+1);
                    $eq = preg_replace('/[\'|"]/', '', $eq);

                    if (!preg_match("/[{]/", $eq))
                    {
                        $eq = ltrim($eq, '<?=');
                        $eq = rtrim($eq, '?>');

                        $eq = '"'.$eq.'"';

                        $other = 'src="<?=$assets->image('.$eq.')?>"';

                        $_ac = str_replace($ma, $other, $ac);
                        $this->interpolateContent = str_replace($replace, $_ac, $this->interpolateContent);

                    }
                }
            }

            $matches = null;

            if (!is_null($this->interpolateContent))
            {
                preg_match_all('/[<](form)(.*?)(hy-action)\s{0,}[=][\'|"]([^\'|"]+)[\'|"]/', $this->interpolateContent, $matches);
                
                foreach ($matches[0] as $i => $ac)
                {
                    $ma = substr($ac, strpos($ac, 'hy-action'));

                    $replace = $ac;

                    $eq = substr($ma, strpos($ma, '=')+1);
                    $eq = preg_replace('/[\'|"]/', '', $eq);
                    $other = null;

                    $eq = preg_replace("/[{]|[}]/", '', $eq);

                    $eq = '"'.$eq.'"';

                    $other = 'action="<?=action('.$eq.')?>"';

                    
                    $_ac = str_replace($ma, $other, $ac);
                    $this->interpolateContent = str_replace($replace, $_ac, $this->interpolateContent);
                }

            }

            $matches = null;

            if (!is_null($this->interpolateContent))
            {
                preg_match_all('/[<](link)([^\$\n]+)(\$href)\s{0,}[=][\'|"]([^\'|"]+)[\'|"]/', $this->interpolateContent, $matches);
                
                foreach ($matches[0] as $i => $ac)
                {
                    $ma = substr($ac, strpos($ac, '$href'));

                    $replace = $ac;


                    $eq = substr($ma, strpos($ma, '=')+1);
                    $eq = preg_replace('/[\'|"]/', '', $eq);
                    $other = null;

                    $eq = preg_replace("/[{]|[}]/", '', $eq);

                    $eq = '"'.$eq.'"';

                    $other = 'href="<?=$assets->css('.$eq.')?>"';

                    
                    $_ac = str_replace($ma, $other, $ac);
                    $this->interpolateContent = str_replace($replace, $_ac, $this->interpolateContent);
                }

            }

            $matches = null;

            if (!is_null($this->interpolateContent))
            {
                preg_match_all('/[<](video|audio|source)(.*?)(hy-media)\s{0,}[=][\'|"]([^\'|"]+)[\'|"]/', $this->interpolateContent, $matches);
                
                foreach ($matches[0] as $i => $ac)
                {
                    $ma = substr($ac, strpos($ac, 'hy-media'));

                    $replace = $ac;

                    $eq = substr($ma, strpos($ma, '=')+1);
                    $eq = preg_replace('/[\'|"]/', '', $eq);
                    $other = null;

                    $eq = preg_replace("/[{]|[}]/", '', $eq);

                    $eq = '"'.$eq.'"';

                    $other = 'src="<?=$assets->media('.$eq.')?>"';

                    $_ac = str_replace($ma, $other, $ac);
                    $this->interpolateContent = str_replace($replace, $_ac, $this->interpolateContent);
                }

            }

            $matches = null;

            if (!is_null($this->interpolateContent))
            {
                preg_match_all('/[<](video|audio|source)(.*?)(hy-poster)\s{0,}[=][\'|"]([^\'|"]+)[\'|"]/', $this->interpolateContent, $matches);
                
                foreach ($matches[0] as $i => $ac)
                {
                    $ma = substr($ac, strpos($ac, '$poster'));

                    $replace = $ac;

                    $eq = substr($ma, strpos($ma, '=')+1);
                    $eq = preg_replace('/[\'|"]/', '', $eq);
                    $other = null;

                    $eq = preg_replace("/[{]|[}]/", '', $eq);

                    $eq = '"'.$eq.'"';

                    $other = 'poster="<?=$assets->image('.$eq.')?>"';

                    $_ac = str_replace($ma, $other, $ac);
                    $this->interpolateContent = str_replace($replace, $_ac, $this->interpolateContent);
                }

            }

            $matches = null;

            if (!is_null($this->interpolateContent))
            {
                preg_match_all('/[<](script)(.*?)(hy-src)\s{0,}[=][\'|"]([^\'|"]+)[\'|"]/', $this->interpolateContent, $matches);

                foreach ($matches[0] as $i => $ac)
                {
                    $ma = substr($ac, strpos($ac, 'hy-src'));

                    $replace = $ac;

                    $eq = substr($ma, strpos($ma, '=')+1);
                    $eq = preg_replace('/[\'|"]/', '', $eq);

                    if (!preg_match("/^[{]/", $eq))
                    {
                        $eq = ltrim($eq, '<?=');
                        $eq = rtrim($eq, '?>');

                        $eq = '"'.$eq.'"';

                        $other = 'src="<?=$assets->js('.$eq.')?>"';

                        $_ac = str_replace($ma, $other, $ac);
                        $this->interpolateContent = str_replace($replace, $_ac, $this->interpolateContent);
                    }
                }
            }

            $matches = null;

            // bind background image
            if (!is_null($this->interpolateContent))
            {
                preg_match_all('/[<]([\S]+)([^>]+)?(hy-background-image)\s{0,}[=][\'|"]([^\'|"]+)[\'|"]([^>]+|)[>|]/', $this->interpolateContent, $matches);

                if (count($matches[0]) > 0)
                {
                    foreach ($matches[0] as $index => $data)
                    {
                        $replace = $data;
                        $var = $matches[4][$index];
                        $var = preg_replace("/[{]|[}]/",'', $var);
                        $var = '"'.$var.'"';
                        $imgStyle = "background-image:url('<?=\$assets->image($var)?>')";
                        preg_match('/(hy-background-image)\s{0,}[=][\'|"]([^\'|"]+)[\'|"]/', $data, $attribute);
                        $attr = $attribute[0];

                        preg_match('/(style)\s{0,}[=][\'|"]([^\'|"]+)[\'|"]/', $data, $style);
                        if (count($style) > 0)
                        {
                            $styles = rtrim(trim(end($style)), ';');
                            $styles .= '; '.$imgStyle.';';
                            $data = str_replace($style[0], 'style="'.$styles.'"', $data);

                        }
                        else
                        {
                            $data = str_replace($attr, 'style="'.$imgStyle.';"', $data);
                        }

                        $data = str_replace($attr,'',$data);

                        $this->interpolateContent = str_replace($replace, $data, $this->interpolateContent);
                    }
                }

            } 
        }
    }

    // remove style
    private function removeStyle()
    {
        $styles = [];

        if (preg_match_all("/(<style)([\s\S]*?)(<\/style>)/m", $this->interpolateContent, $matches))
        {
            foreach ($matches[0] as $index => $style)
            {
                $hash = md5($style);
                $styles[$hash] = $style;
                $this->interpolateContent = str_replace($style, "($hash)", $this->interpolateContent);
            }

            $this->styles = array_merge($this->styles, $styles);
        }
    }

    // add style
    private function addStyle()
    {
        if (count($this->styles) > 0)
        {
            foreach ($this->styles as $hash => $style)
            {
                $this->interpolateContent = str_replace("($hash)", $style, $this->interpolateContent);
            }
        }
    }

    // external
    public function interpolateExternal($data, &$interpolated = null)
    {
        $continue = true;

        static $hasScript;

        if ($hasScript == null)
        {
            $hasScript = [];
        }

        $data = html_entity_decode($data, ENT_QUOTES, 'UTF-8');

        $script = strstr($data, "<script");

        if ($script !== false)
        {
            preg_match_all('/(<script)\s*(.*?)>/', $script, $s);
            if (count($s[0]) > 0)
            {
                foreach ($s[0] as $i => $x)
                {
                    $tag = $x;
                    $block = $this->getblock($script, $tag, 'script');
                    $strip = trim(strip_tags($block));
                    if (strlen($strip) > 3)
                    {
                        $hash = md5($block);
                        $hasScript[$hash] = $block;
                        $data = str_replace($block, $hash, $data);
                    }
                }
            }
        }

        $this->interpolateContent = $data;

        // remove style
        $this->removeStyle();

        preg_match_all('/({[\s\S]*?)}/m', $this->interpolateContent, $matches);

        if (count($matches) > 0 && count($matches[0]) > 0)
        {
            foreach ($matches[0] as $a => $m)
            {
                if (substr($m, 0, 2) != '{{')
                {
                    $brace = trim($m);
                    $m = ltrim($m, '{');
                    $m = rtrim($m, '}');
                    $m = trim($m);

                    if (preg_match("/^(([\$][\S]+)|([\S]*?[\(]))/", $m))
                    {
                        $type = '=';

                        $c = trim($m);
                        if (preg_match('/[;]$/', $c))
                        {
                            $type = 'php ';
                        }

                        $this->interpolateContent = str_replace($brace, '<?'.$type.$m.'?>', $this->interpolateContent);
                    }
                }
            }
        }

        // convert shortcuts.
        $this->convertShortcuts($this->interpolateContent);

        if ($hasScript !== null)
        {
            if (is_array($hasScript) && count($hasScript) > 0)
            {
                foreach($hasScript as $hash => $block)
                {
                    $this->interpolateContent = str_replace($hash, $block, $this->interpolateContent);
                }
            }
        }

        // add style tag
        $this->addStyle();
        $interpolated = $this->interpolateContent;

        return $interpolated;
    }

    // Helper methods
    private static function getAllFiles($dir)
    {
        $files = [];

        $files = self::___allfiles($dir);

        return $files;
    }

    // for get all files.
    private static function ___allfiles($dir)
    {
        $file = [];

        $glob = glob(rtrim($dir, '/') .'/{,.}*', GLOB_BRACE);

        if (count($glob) > 0)
        {
            foreach ($glob as $i => $p)
            {
                if (basename($p) != '.' && basename($p) != '..')
                {
                    $p = preg_replace("/[\/]{2}/", '/', $p);

                    if (is_file($p))
                    {
                        $file[] = $p;
                    }
                    elseif (is_dir($p))
                    {
                        $file[] = self::___allfiles($p);
                    }
                }
            }
        }
        
        $glob = null;

        return $file;
    }

    // reduce array
    private static function reduce_array($array)
    {	
        $arr = [];
        $arra = self::__reduceArray($array, $arr);

        return $arra;
    }

    private static function __reduceArray($array, $arr)
    {

        if (is_array($array))
        {
            foreach ($array as $a => $val)
            {
                if (!is_array($val))
                {
                     $arr[] = $val;
                }
                else
                {
                    foreach($val as $v => $vf)
                    {
                        if (!is_array($vf))
                        {
                            $arr[] = $vf;
                        }
                        else
                        {
                            $arr = self::__reduceArray($vf, $arr);
                        }
                    }
                }
            }
        }

        return $arr;
    }

    // get block of html code
    public function getblock($html, $tag, $tagName)
    {
        $html = strstr($html, $tag);
        $html = substr($html, strlen($tag));


        $replace = [];
        //$html = preg_replace("/(<\s*\w.*\s*\"?\s*([\w\s%#\/\.;:_-]*)\s*\"?.*>)/", "<>\n".'$1', $html);
        $hr = $this->__getblock($html, $tag, $tagName, $replace);


        // get end tag now
        $end = strpos($hr, "</$tagName>");
        $endline = substr(trim($tag),-2);
        $tags = new Tag();

        $lower = strtolower($tagName);
        $selfclosing = array_flip($tags->selfClosing);

        if ($endline != '/>' && !isset($selfclosing[$lower]))
        {
            $block = $tag . substr($hr, 0, $end) . "</$tagName>";

            $repl = [];
            $gb = $this->__getblock($block, $tag, $tagName, $repl);

            $end = strpos($gb, "</$tagName>");

            if ($end !== false)
            {
                $gb = substr($gb, 0, $end);
            }
            foreach ($repl as $stamp => $rep)
            {
                $gb = str_replace($stamp, $rep, $gb);
            }

            $block = $gb;
        }
        else
        {
            $block = $tag . substr($hr, 0, $end);
        }

        // check if replace has things to do
        if (count($replace) > 0)
        {
            foreach ($replace as $stamp => $rep)
            {
                $block = str_replace($stamp, $rep, $block);
            }
        }

        //$block = preg_replace("/(<\s*\w.*\s*\"?\s*([\w\s%#\/\.;:_-]*)\s*\"?.*>)(<>\n)/",'$1', $block);

        //var_dump($block);

        return $block;
    }

    private function __getblock($html, $tag, $tagName, &$replace = [])
    {
        $closeTag = strpos($html, "</$tagName>");

        if ($closeTag !== false)
        {
            $beforecloseTag = substr($html, 0, $closeTag + strlen("</$tagName>"));

            // find starting tag
            $start = strpos($beforecloseTag, "<$tagName");
            if ($start !== false)
            {
                $block = substr($beforecloseTag, $start);
                $hash = '{'.md5($block).'}';
                $before = $beforecloseTag;
                $beforecloseTag = str_replace($block, $hash, $beforecloseTag);
                $replace[$hash] = $block;
                $html = str_replace($before, $beforecloseTag, $html);
                $html = $this->__getblock($html, $tag, $tagName, $replace);

                return $html;
            }
            else
            {
                return $html;
            }
        }

        return $html;
    }
}