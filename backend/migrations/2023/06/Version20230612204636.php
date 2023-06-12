<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230612204636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE screen ALTER content TYPE TEXT');
        $this->addSql('ALTER TABLE section ALTER description TYPE TEXT');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE section ALTER description TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE screen ALTER content TYPE VARCHAR(255)');
    }
}
