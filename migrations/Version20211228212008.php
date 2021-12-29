<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228212008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ready (id INT AUTO_INCREMENT NOT NULL, nigend INT DEFAULT NULL, user_name VARCHAR(25) DEFAULT NULL, loan_date DATE DEFAULT NULL, loan_return_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE confiscation CHANGE pvNumber pvNumber CHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE material ADD ready_id INT DEFAULT NULL, CHANGE confiscation_id confiscation_id INT NOT NULL, CHANGE state state ENUM(\'READY\',\'STOCK\',\'DESTROY\',\'BEINGDESTROY\'), CHANGE status status ENUM(\'UNLOCK\',\'TOBLOCK\',\'UNUSABLE\')');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE75954CAC55E2 FOREIGN KEY (confiscation_id) REFERENCES confiscation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE759572F4D480 FOREIGN KEY (ready_id) REFERENCES ready (id)');
        $this->addSql('CREATE INDEX IDX_7CBE759572F4D480 ON material (ready_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE759572F4D480');
        $this->addSql('DROP TABLE ready');
        $this->addSql('ALTER TABLE confiscation CHANGE pvNumber pvNumber CHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE75954CAC55E2');
        $this->addSql('DROP INDEX IDX_7CBE759572F4D480 ON material');
        $this->addSql('ALTER TABLE material DROP ready_id, CHANGE confiscation_id confiscation_id INT DEFAULT NULL, CHANGE state state VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE status status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
