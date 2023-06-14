<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230614112601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add metaInformation to Entry, Section and fix EntityIntegerId columns';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('COMMENT ON COLUMN element.id IS \'(DC2Type:element_id)\'');
        $this->addSql('COMMENT ON COLUMN element.section_id IS \'(DC2Type:section_id)\'');
        $this->addSql('COMMENT ON COLUMN element_entry.id IS \'(DC2Type:element_entry_id)\'');
        $this->addSql('COMMENT ON COLUMN element_entry.entry_id IS \'(DC2Type:entry_id)\'');
        $this->addSql('COMMENT ON COLUMN element_entry.element_id IS \'(DC2Type:element_id)\'');
        $this->addSql('ALTER TABLE entry ADD meta_information JSON NOT NULL');
        $this->addSql('ALTER TABLE entry ADD submitted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN entry.meta_information IS \'(DC2Type:entry_meta_information_vo)\'');
        $this->addSql('COMMENT ON COLUMN entry.id IS \'(DC2Type:entry_id)\'');
        $this->addSql('COMMENT ON COLUMN entry.form_id IS \'(DC2Type:form_id)\'');
        $this->addSql('COMMENT ON COLUMN form.id IS \'(DC2Type:form_id)\'');
        $this->addSql('COMMENT ON COLUMN form.welcome_screen_id IS \'(DC2Type:screen_id)\'');
        $this->addSql('COMMENT ON COLUMN form.submit_screen_id IS \'(DC2Type:screen_id)\'');
        $this->addSql('COMMENT ON COLUMN screen.id IS \'(DC2Type:screen_id)\'');
        $this->addSql('ALTER TABLE section ADD meta_information JSON NOT NULL');
        $this->addSql('ALTER TABLE section ALTER description DROP NOT NULL');
        $this->addSql('COMMENT ON COLUMN section.meta_information IS \'(DC2Type:section_meta_information_vo)\'');
        $this->addSql('COMMENT ON COLUMN section.id IS \'(DC2Type:section_id)\'');
        $this->addSql('COMMENT ON COLUMN section.form_id IS \'(DC2Type:form_id)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('COMMENT ON COLUMN element_entry.id IS NULL');
        $this->addSql('COMMENT ON COLUMN element_entry.entry_id IS NULL');
        $this->addSql('COMMENT ON COLUMN element_entry.element_id IS NULL');
        $this->addSql('ALTER TABLE entry DROP meta_information');
        $this->addSql('ALTER TABLE entry DROP submitted_at');
        $this->addSql('COMMENT ON COLUMN entry.id IS NULL');
        $this->addSql('COMMENT ON COLUMN entry.form_id IS NULL');
        $this->addSql('ALTER TABLE section DROP meta_information');
        $this->addSql('ALTER TABLE section ALTER description SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN section.id IS NULL');
        $this->addSql('COMMENT ON COLUMN section.form_id IS NULL');
        $this->addSql('COMMENT ON COLUMN element.id IS NULL');
        $this->addSql('COMMENT ON COLUMN element.section_id IS NULL');
        $this->addSql('COMMENT ON COLUMN screen.id IS NULL');
        $this->addSql('COMMENT ON COLUMN form.id IS NULL');
        $this->addSql('COMMENT ON COLUMN form.welcome_screen_id IS NULL');
        $this->addSql('COMMENT ON COLUMN form.submit_screen_id IS NULL');
    }
}
