<?php
namespace Moorexa;

use Moorexa\DB;
use Moorexa\Event;
use Moorexa\HttpPost as post;
use WekiWork\Fileio;
use Centurion\Models\Input;
use Centurion\Models\Table;

/**
 * Partner model class auto generated.
 *
 *@package	Partner Model
 *@author  	Moorexa <www.moorexa.com>
 **/

class Partner extends Model
{
    // add room
    public function postRoomsAdd($listingid, post $post, Fileio $fileio, Table $table)
    {
        $roomCreated = false;
        $model = createModelRule(function($body){ $body->allow_form_inputs(); });

        // check if listing id exists, then proceed.
        if ($this->query->listingExists($listingid, $listinginfo))
        {
            // get json data
            $jsonData = json_decode($listinginfo->listing_information);
            // add room data
            $jsonData->property_room_title[] = $post->room_type;
            $jsonData->sleeps[] = $post->sleeps;
            $jsonData->room_price[] = $post->room_price;
            $jsonData->total_rooms[] = $post->total_rooms;
            $jsonData->about_room[] = [$post->about_room];
            $jsonData->room_number[] = [$post->room_number];
            $jsonData->room[] = $post->room;

            $destination = PARTNER_PATH . 'Images/Listing/';
            $getAllImages = [];

            // destination callback function
            $destinationCallbackFunction = function($filename, $fullpath) use (&$getAllImages)
            {
                $getAllImages[] = $fullpath;
            };

            // get room images
            $roomImages = json_decode($listinginfo->room_images);

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

            // add images 
            $roomImages->images[] = reduce_array($allRoomImages);

            // build 
            $listing = $table->useRule('PropertyListing');
            $listing->listingid = $listingid;
            $listing->listing_information(json_encode($jsonData));
            $listing->listing_images($listinginfo->listing_images);
            $listing->room_images(json_encode($roomImages));

            if ($listing->update())
            {
                $roomCreated = true;
                $model->clear(); // clear model.
            }

            // pass model back to view
            Input::pass($model);
        }

        return $roomCreated;
    }

    // update property
    public function postEditProperty(int $listingid, post $post, Fileio $fileio, Table $table)
    {
        $updated = false;

        $model = createModelRule(function($body){ $body->allow_form_inputs(); });

        // get listing information
        $listing = $this->query->getListingById($listingid);

        // get property_images_copy
        $propertyImages = $post->property_images_copy;

        // convert to array
        $propertyImagesArray = explode(',', $propertyImages);

        // flip image array
        $propertyImagesArray = array_flip($propertyImagesArray);

        // get listing information
        $info = json_decode($listing->listing_information);

        // get property images from listing row
        $propertyImagesListing = json_decode($listing->listing_images)->images;

        // now get those images
        $newImage = [];

        foreach ($propertyImagesListing as $imagePath)
        {
            // get base name
            $base = basename($imagePath);

            // now we move to newimage if exists
            if (isset($propertyImagesArray[$base]))
            {
                $newImage[] = $imagePath;
            }
        }

        $propertyImagesListing = $newImage;

        // now we update
        $info->property_address = $post->property_address;
        $info->property_type = $post->property_type;
        $info->about_property = $post->about_property;
        $info->property_rule = $post->property_rule;
        $info->facility = $post->facility;

        $getAllImages = [];

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

        // merge images
        $propertyImagesListing = array_merge($propertyImagesListing, $getAllImages);

        $update = [
            'listing_information' => json_encode($info),
            'listing_images' => json_encode(['images' => $propertyImagesListing])
        ];
        
        // upload cover photo
        $fileio->upload('cover_image')->to($destination, function($filename, $fullpath) use (&$update){
            $update['cover_image'] = $fullpath;
        });

        // update 
        if ($listing->update($update)->ok)
        {
            $updated = true;
        }

        Input::pass($model);

        return $updated;
    }
}
