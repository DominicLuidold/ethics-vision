<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230607061351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Form related tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE element_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE form_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE screen_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE section_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE element (id INT NOT NULL, section_id INT NOT NULL, type VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, placeholder VARCHAR(255) DEFAULT NULL, position INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_41405E39D823E37A ON element (section_id)');
        $this->addSql('CREATE TABLE form (id INT NOT NULL, welcome_screen_id INT NOT NULL, submit_screen_id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5288FD4F68EBB35F ON form (welcome_screen_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5288FD4F1F12109C ON form (submit_screen_id)');
        $this->addSql('CREATE TABLE screen (id INT NOT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE section (id INT NOT NULL, form_id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, position INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2D737AEF5FF69B7D ON section (form_id)');
        $this->addSql('ALTER TABLE element ADD CONSTRAINT FK_41405E39D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE form ADD CONSTRAINT FK_5288FD4F68EBB35F FOREIGN KEY (welcome_screen_id) REFERENCES screen (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE form ADD CONSTRAINT FK_5288FD4F1F12109C FOREIGN KEY (submit_screen_id) REFERENCES screen (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF5FF69B7D FOREIGN KEY (form_id) REFERENCES form (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE element_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE form_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE screen_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE section_id_seq CASCADE');
        $this->addSql('ALTER TABLE element DROP CONSTRAINT FK_41405E39D823E37A');
        $this->addSql('ALTER TABLE form DROP CONSTRAINT FK_5288FD4F68EBB35F');
        $this->addSql('ALTER TABLE form DROP CONSTRAINT FK_5288FD4F1F12109C');
        $this->addSql('ALTER TABLE section DROP CONSTRAINT FK_2D737AEF5FF69B7D');
        $this->addSql('DROP TABLE element');
        $this->addSql('DROP TABLE form');
        $this->addSql('DROP TABLE screen');
        $this->addSql('DROP TABLE section');
    }
}
