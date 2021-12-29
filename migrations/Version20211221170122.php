<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211221170122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE confiscation (id INT AUTO_INCREMENT NOT NULL, pvNumber CHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D44078F866341029 (pvNumber), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, imeiNumber CHAR(255) NOT NULL, marque VARCHAR(35) DEFAULT NULL, observation LONGTEXT DEFAULT NULL, state ENUM(\'READY\',\'STOCK\',\'DESTROY\',\'BEINGDESTROY\'), status ENUM(\'UNLOCK\',\'TOBLOCK\',\'UNUSABLE\'), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_7CBE7595C58F3D17 (imeiNumber), INDEX IDX_7CBE7595C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material_confiscation (material_id INT NOT NULL, confiscation_id INT NOT NULL, INDEX IDX_DA38ECF8E308AC6F (material_id), INDEX IDX_DA38ECF84CAC55E2 (confiscation_id), PRIMARY KEY(material_id, confiscation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE7595C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE material_confiscation ADD CONSTRAINT FK_DA38ECF8E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE material_confiscation ADD CONSTRAINT FK_DA38ECF84CAC55E2 FOREIGN KEY (confiscation_id) REFERENCES confiscation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE material_confiscation DROP FOREIGN KEY FK_DA38ECF84CAC55E2');
        $this->addSql('ALTER TABLE material_confiscation DROP FOREIGN KEY FK_DA38ECF8E308AC6F');
        $this->addSql('DROP TABLE confiscation');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE material_confiscation');
    }
}
