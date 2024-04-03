<?php

declare(strict_types=1);

require_once 'src/core/db/AbstractEntity.php';

require_once 'src/modules/page/models/Page.php';

use PHPUnit\Framework\TestCase;
use \modules\page\models\Page;


class FakeSmt
{
    function execute()
    {
        echo 'Ran fake execute ';
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

    public function testSave(): void
    {
        $mockDatabase = $this->getMockBuilder(FakeDatabaseConnection::class)
            ->onlyMethods(["prepare"])
            ->disableOriginalConstructor()
            ->getMock();

        $mockDatabase->expects($this->exactly(2))
            ->method('prepare')
            ->with(
                $this->logicalOr(
                    $this->equalTo('SELECT * FROM pages WHERE id = :value'),
                    $this->equalTo('UPDATE pages SET title = :title, content = :content WHERE id = :id')
                )

            )->willReturn(new FakeSmt());

        $page = new Page($mockDatabase);

        $page->findBy('id', 10);

        $page->title = "new title";
        $page->save();

        $this->assertEquals("new title", $page->title);
    }
}
