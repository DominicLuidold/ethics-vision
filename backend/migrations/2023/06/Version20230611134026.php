<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230611134026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add createdAt, updatedAt fields for Entry';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE entry ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE entry ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE entry DROP created_at');
        $this->addSql('ALTER TABLE entry DROP updated_at');
    }
}
