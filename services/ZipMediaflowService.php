<?php
namespace Craft;

class ZipMediaflowService extends BaseApplicationComponent 
{

    public function download($files, $filename)
    { 
        // Set destination zip
        $destZip = craft()->path->getTempPath() . $filename . '-' . time() . '.zip';
        $finalZip = craft()->path->getTempPath() . $filename . '.zip';
        
        // Remove destination zip if exists
        if (file_exists($destZip)) {
            unlink($destZip);
        }
            
        // Create the zipfile
        IOHelper::createFile($destZip);
        
        // Loop through assets
        foreach($files as $file) {
            $filename = explode("?",basename($file));
            $img = craft()->path->getTempPath().$filename[0];
            file_put_contents($img, file_get_contents($file));
          
            // Add to zip
            Zip::add($destZip, $img, craft()->path->getTempPath());
        }
            
        // Remove final zip if exists
        if (file_exists($finalZip)) {
            unlink($finalZip);
        }
        
        // Rename zip
        rename($destZip, $finalZip);
        
        // Return final destination
        return $finalZip;
    }
    
}