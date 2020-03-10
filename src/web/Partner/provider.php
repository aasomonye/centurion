<?php

/**
 * Partner Provider. Will be loaded before the Partner controller
 * @package App provider
 */

class PartnerProvider extends Partner
{
    // load class aliases 
    public $classAliases = [
        'query' => Centurion\Helpers\Query::class
    ];
    
    /**
     * @method PartnerProvider boot
     * This method would be called before controller renders a view
     * @param $next
     */
    public function boot($next)
    {
        config('loadStatic', read_json(HOME . 'Centurion/Public/adminStaticPack.json'));

        // call view! Applies Globally.
        $next();
    }

    /**
     * @method PartnerProvider onHomeInit
     * This method would be called upon route request to Partner/home
     * @param $next
     */
    public function onRoomsInit($next)
    {
        // route passed!
        $next();

        // require filepond
        $this->requirecss('https://unpkg.com/file-upload-with-preview@4.0.2/dist/file-upload-with-preview.min.css');
        $this->requirejs('https://unpkg.com/file-upload-with-preview@4.0.2/dist/file-upload-with-preview.min.js', 'before Partner.js'); 
    }

    // set active method
    public function setActive(string $tab)
    {
        if ($this->has('setActive') && $this->setActive == $tab)
        {
            return 'active show';
        }
        else
        {
            if ($tab == 'default' && !$this->has('setActive')) { return 'active show'; }
        }
    }

    public function onEditPropertyInit($next)
    {
        // route passed!
        $next();

        // require filepond
        $this->requirecss('https://unpkg.com/file-upload-with-preview@4.0.2/dist/file-upload-with-preview.min.css');
        $this->requirejs('https://unpkg.com/file-upload-with-preview@4.0.2/dist/file-upload-with-preview.min.js', 'before Partner.js'); 
    }

    // you can register more init methods for your view models.
}