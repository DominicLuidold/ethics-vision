<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230616144444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Convert ElementEntry `value` property to text';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE element_entry ALTER value TYPE TEXT');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE element_entry ALTER value TYPE VARCHAR(255)');
    }
}
