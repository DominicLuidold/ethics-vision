<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230609074759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Entry related tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE element_entry_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE entry_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE element_entry (id INT NOT NULL, entry_id INT NOT NULL, element_id INT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EF03E9E9BA364942 ON element_entry (entry_id)');
        $this->addSql('CREATE INDEX IDX_EF03E9E91F1F2A24 ON element_entry (element_id)');
        $this->addSql('CREATE TABLE entry (id INT NOT NULL, form_id INT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2B219D705FF69B7D ON entry (form_id)');
        $this->addSql('ALTER TABLE element_entry ADD CONSTRAINT FK_EF03E9E9BA364942 FOREIGN KEY (entry_id) REFERENCES entry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE element_entry ADD CONSTRAINT FK_EF03E9E91F1F2A24 FOREIGN KEY (element_id) REFERENCES element (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D705FF69B7D FOREIGN KEY (form_id) REFERENCES form (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE element_entry_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE entry_id_seq CASCADE');
        $this->addSql('ALTER TABLE element_entry DROP CONSTRAINT FK_EF03E9E9BA364942');
        $this->addSql('ALTER TABLE element_entry DROP CONSTRAINT FK_EF03E9E91F1F2A24');
        $this->addSql('ALTER TABLE entry DROP CONSTRAINT FK_2B219D705FF69B7D');
        $this->addSql('DROP TABLE element_entry');
        $this->addSql('DROP TABLE entry');
    }
}
