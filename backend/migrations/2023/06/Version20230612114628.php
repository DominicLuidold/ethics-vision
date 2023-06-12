<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230612114628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add unique constraints to Element';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX UNIQ_41405E39D823E37A2B36786B ON element (section_id, title)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_41405E39D823E37A462CE4F5 ON element (section_id, position)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_41405E39D823E37A2B36786B');
        $this->addSql('DROP INDEX UNIQ_41405E39D823E37A462CE4F5');
    }
}
