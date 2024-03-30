<?php 


namespace app\tests;

use PHPUnit\Framework\TestCase;
use app\models\SectorModel;



class SectorModelTest extends TestCase
{
    public function testGetField()
    {
    
        $pkName = 'id_sector';
        $pkValue = 1;
        $requestedFields = ['id_sector', 'sector_name'];
        $expectedResult = [[
            'id_sector' => 1,
            'sector_name' => 'Recursos Humanos',
        ]];

    
        $result = SectorModel::getField($pkName, $pkValue, $requestedFields);


        $this->assertEquals($expectedResult, $result);
    }

    public function testCreateSector()
    {   
        $name = 'New Sector';

        $result = SectorModel::createSector($name);

        $this->assertTrue($result);
        SectorModel::deleteSector("sector_name", "New Sector");
    }



    public function testDeleteSector()
    {
        $name = 'New Sector';

        $result = SectorModel::createSector($name);

        $this->assertTrue($result);

        $result = SectorModel::deleteSector("sector_name", "New Sector");

        $this->assertTrue($result);
    }

    public function testUpdateSector()
    {
        $name = 'New Sector';

        $result = SectorModel::createSector($name);
        $expectedFields = [['sector_name' => "Newer Sector"]];

        $this->assertTrue($result);

        $result = SectorModel::updateSector("sector_name", "New Sector", "Newer Sector");

        $this->assertTrue($result);

        $currentFields = SectorModel::getField("sector_name", "Newer Sector", ["sector_name"]);

        $this->assertEquals($expectedFields, $currentFields);

        $status = SectorModel::deleteSector("sector_name", "Newer Sector");
        $this->assertTrue($status);
    }
}