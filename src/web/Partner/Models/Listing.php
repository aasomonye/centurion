<?php
namespace Moorexa;

use Moorexa\DB;
use Moorexa\Event;
use Moorexa\HttpPost as Post;
use Centurion\Models\Input;
use Centurion\Helpers\Alert;
use Centurion\Models\Table;
use WekiWork\Fileio;

/**
 * Listing model class auto generated.
 *
 *@package	Listing Model
 *@author  	Moorexa <www.moorexa.com>
 **/

class Listing extends Model
{

    public function getPropertyList()
    {
        // get all facilities for rooms
        $roomFacilities = $this->query->getAllRoomFacilities();

        // get all rules for rooms
        $roomRules = $this->query->getAllRoomRules();
    }

    // magic method
    public function __PropertyList()
    {
        // add modal text
        dropbox('modalText', '<div class="modal-dialog modal-xl"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">Room Information</h4> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div><div class="modal-body"></div><div class="modal-footer justify-content-between"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button><div class="modal-buttons"> <a href="javascript:void(0)" class="btn btn-success">Save</a></div></div></div></div>');

        // require php vars
        $this->requirejs('php-vars.js');

        // require filepond
        $this->requirecss('https://unpkg.com/file-upload-with-preview@4.0.2/dist/file-upload-with-preview.min.css');
        $this->requirejs('https://unpkg.com/file-upload-with-preview@4.0.2/dist/file-upload-with-preview.min.js', 'before Partner.js'); 
    }

    // process property listing
    public function postPropertyList(Post $post, Fileio $fileio, Table $table)
    {
        // create model rule
        $model = createModelRule(function($rule){
            $rule->allow_form_input();
        });

        // get files
        $files = $post->files;
        $getAllImages = [];
        $propertyCreated = false;

        // property images
        $property_images = [];
        $destination = PARTNER_PATH . 'Images/Listing/';

        // destination callback function
        $destinationCallbackFunction = function($filename, $fullpath) use (&$getAllImages)
        {
            $getAllImages[] = $fullpath;
        };

        // upload property_images
        $fileio->upload('property_images')
        ->to($destination, $destinationCallbackFunction);

        // move all images at this point
        $property_images = $getAllImages;

        // upload room_images
        $room_images = $post->files['room_images'];
        
        // reset images
        $getAllImages = [];

        // room images
        $allRoomImages = [];

        foreach ($room_images['name'] as $roomIndex => $roomData)
        {
            $upload = [
                'name' => $roomData,
                'tmp_name' => $room_images['tmp_name'][$roomIndex],
                'type' => $room_images['type'][$roomIndex],
                'size' => $room_images['size'][$roomIndex]
            ];  

            $fileio->singleUpload('room_images', $upload)
            ->to($destination, $destinationCallbackFunction);

            // add images
            $allRoomImages[$roomIndex] = $getAllImages;

            // reset again
            $getAllImages = [];
        }

        // build json string for property images
        $propertyImagesJson = json_encode(['images' => $property_images]);

        // build json string for room images
        $roomImagesJson = json_encode(['images' => $allRoomImages]);

        // build 
        $listing = $table->useRule('PropertyListing');
        $listing->listing_information(json_encode($post->data()));
        $listing->listing_images($propertyImagesJson);
        $listing->room_images($roomImagesJson);

        // upload cover_image
        $fileio->upload('cover_image')
        ->to($destination, function($filename, $filepath) use (&$listing){
            $listing->cover_image = $filepath;
        });

        if ($listing->create())
        {
            $propertyCreated = true;
            $model->clear(); // clear model.
        }

        // pass model back to view
        Input::pass($model);

        return $propertyCreated;
    }

    // remove from listing
    public function removeFromListing(int $listingid, DBPromise $listInfo)
    {
        // delete all images
        $listingImages = json_decode($listInfo->listing_images);

        if (is_object($listingImages))
        {
            foreach ($listingImages->images as $imagePath)
            {
                if (file_exists($imagePath))
                {
                    // remove image from path
                    unlink($imagePath);
                }
            }
        }

        // remove room images if property
        $roomImages = json_decode($listInfo->room_images);

        if (is_object($roomImages))
        {
            // reduce array
            $images = reduce_array($roomImages->images);
            
            foreach ($images as $imagePath)
            {
                // remove image from path
                unlink($imagePath);
            }
        }

        // delete listing
        if (db('partner_listing')->delete()->primary($listingid)->ok)
        {
            return true;
        }

        return false;
    }

    // close listing
    public function getPropertyClose(int $listingid)
    {
        // close listing
        $listing = $this->query->getListingById($listingid);

        if ($listing->update(['approved' => 3])->ok)
        {
            $info = json_decode($listing->listing_information);

            // possibly, send a message to user.
            Alert::toastDefaultSuccess($info->property_name . ' closed successfully');
        }
    }

    // open listing
    public function getPropertyOpen(int $listingid)
    {
        // close listing
        $listing = $this->query->getListingById($listingid);

        if ($listing->update(['approved' => 1])->ok)
        {
            $info = json_decode($listing->listing_information);

            // possibly, send a message to user.
            Alert::toastDefaultSuccess($info->property_name . ' opened successfully');
        }
    }
}