<?php

/**
 * This file is part of the contentful.php package.
 *
 * @copyright 2015-2017 Contentful GmbH
 * @license   MIT
 */

namespace Contentful\Tests\E2E;

use Contentful\Delivery\Query;
use Contentful\ResourceArray;
use Contentful\Tests\Delivery\End2EndTestCase;

class EntrySearchTest extends End2EndTestCase
{
    /**
     * @vcr e2e_entry_search_by_content_type.json
     */
    public function testSearchByContentType()
    {
        $client = $this->getClient('cfexampleapi');

        $query = (new Query())
            ->setContentType('cat');

        $entries = $client->getEntries($query);

        $this->assertInstanceOf(ResourceArray::class, $entries);
    }

    /**
     * @vcr e2e_entry_search_equality.json
     */
    public function testSearchEquality()
    {
        $client = $this->getClient('cfexampleapi');

        $query = (new Query())
            ->where('sys.id', 'nyancat');

        $entries = $client->getEntries($query);

        $this->assertInstanceOf(ResourceArray::class, $entries);
        $this->assertCount(1, $entries);
    }

    /**
     * @vcr e2e_entry_search_inequality.json
     */
    public function testSearchInequality()
    {
        $client = $this->getClient('cfexampleapi');

        $query = (new Query())
            ->where('sys.id', 'nyancat', 'ne');

        $entries = $client->getEntries($query);

        $this->assertInstanceOf(ResourceArray::class, $entries);
        $this->assertCount(9, $entries);
    }

    /**
     * @vcr e2e_entry_search_array_equals.json
     */
    public function testSearchArrayEquality()
    {
        $client = $this->getClient('cfexampleapi');

        $query = (new Query())
            ->setContentType('cat')
            ->where('fields.likes', 'lasagna');

        $entries = $client->getEntries($query);

        $this->assertInstanceOf(ResourceArray::class, $entries);
    }

    /**
     * @vcr e2e_entry_search_inclusion.json
     */
    public function testSearchInclusion()
    {
        $client = $this->getClient('cfexampleapi');

        $query = (new Query())
            ->where('sys.id', 'finn,jake', 'in');

        $entries = $client->getEntries($query);

        $this->assertInstanceOf(ResourceArray::class, $entries);
        $this->assertCount(2, $entries);
    }

    // Existance test has problems with php-vcr

    /**
     * @vcr e2e_entry_search_range.json
     */
    public function testSearchRange()
    {
        $client = $this->getClient('cfexampleapi');

        $query = (new Query())
            ->where('sys.updatedAt', new \DateTimeImmutable('2013-01-01T00:00:00Z'), 'lte');

        $entries = $client->getEntries($query);

        $this->assertInstanceOf(ResourceArray::class, $entries);
    }

    /**
     * @vcr e2e_entry_search_full_text.json
     */
    public function testSearchFullText()
    {
        $client = $this->getClient('cfexampleapi');

        $query = (new Query())
            ->where('query', 'bacon');

        $entries = $client->getEntries($query);

        $this->assertInstanceOf(ResourceArray::class, $entries);
    }

    /**
     * @vcr e2e_entry_search_full_text_on_field.json
     */
    public function testSearchFullTextOnField()
    {
        $client = $this->getClient('cfexampleapi');

        $query = (new Query())
            ->setContentType('dog')
            ->where('fields.description', 'bacon pancakes', 'match');

        $entries = $client->getEntries($query);

        $this->assertInstanceOf(ResourceArray::class, $entries);
    }
}
