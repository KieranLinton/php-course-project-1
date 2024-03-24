<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;


require_once 'src/db/AbstractEntity.php';
require_once 'src/modules/page/models/Page.php';


class FakeSmt
{
    function execute()
    {
    }
    function fetchAll()
    {
        return [
            ['id' => 10, 'title' => 'fake title', 'content' => 'fake content'],
            ['id' => 2, 'title' => 'fake title', 'content' => 'fake content'],
            ['id' => 3, 'title' => 'fake title', 'content' => 'fake content'],
            ['id' => 4, 'title' => 'fake title', 'content' => 'fake content']
        ];
    }
}
class FakeDatabaseConnection
{
    public function prepare()
    {
        return new FakeSmt();
    }
}

final class ActiveRecordTest extends TestCase
{
    public function testFindAll(): void
    {
        $fakeDbc = new FakeDatabaseConnection();
        $page = new Page($fakeDbc);

        $result = $page->findAll();

        $this->assertCount(4, $result);
        $this->assertEquals(10, $result[0]->id);
    }

    public function testFindBy(): void
    {
        $fakeDbc = new FakeDatabaseConnection();
        $page = new Page($fakeDbc);

        $page->findBy("id", 10);

        $this->assertEquals(10, $page->id);
    }
}
