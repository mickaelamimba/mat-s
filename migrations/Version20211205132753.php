<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211205132753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE confiscation (pvNumber CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', PRIMARY KEY(pvNumber)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE material ADD confiscation CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', CHANGE state state ENUM(\'READY\',\'STOCK\',\'DESTROY\',\'BEINGDESTROY\'), CHANGE status status ENUM(\'UNLOCK\',\'TOBLOCK\',\'UNUSABLE\')');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE7595D44078F8 FOREIGN KEY (confiscation) REFERENCES confiscation (pvNumber)');
        $this->addSql('CREATE INDEX IDX_7CBE7595D44078F8 ON material (confiscation)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE7595D44078F8');
        $this->addSql('DROP TABLE confiscation');
        $this->addSql('DROP INDEX IDX_7CBE7595D44078F8 ON material');
        $this->addSql('ALTER TABLE material DROP confiscation, CHANGE state state VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE status status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
