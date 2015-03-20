<?php
namespace Craft;

class ZipMediaflowTest extends BaseTest 
{
    
    public function setUp()
    {
    
        // Load plugins
        $pluginsService = craft()->getComponent('plugins');
        $pluginsService->loadPlugins();
    
    } 
    
    public function testActionDownload() 
    {
    
        // fetch random assets
        $criteria = craft()->elements->getCriteria(ElementType::Asset);
        $criteria->limit = 2;
        
        // send asset ids and generate zip
        $zipfile = craft()->zipAssets->download($criteria->ids(), 'testzip');
        
        // check if we got a zip
        $this->assertFileExists($zipfile);
        
    }
    
}