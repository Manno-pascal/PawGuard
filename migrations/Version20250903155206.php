<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250903155206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vaccination_record (id INT AUTO_INCREMENT NOT NULL, pet_id INT NOT NULL, veterinarian_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, injection_date DATETIME NOT NULL, vaccination_duration INT DEFAULT NULL, injection_count INT NOT NULL, total_injection_count INT NOT NULL, INDEX IDX_A836BE99966F7FB6 (pet_id), INDEX IDX_A836BE99804C8213 (veterinarian_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE veterinarian (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vaccination_record ADD CONSTRAINT FK_A836BE99966F7FB6 FOREIGN KEY (pet_id) REFERENCES pet (id)');
        $this->addSql('ALTER TABLE vaccination_record ADD CONSTRAINT FK_A836BE99804C8213 FOREIGN KEY (veterinarian_id) REFERENCES veterinarian (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vaccination_record DROP FOREIGN KEY FK_A836BE99966F7FB6');
        $this->addSql('ALTER TABLE vaccination_record DROP FOREIGN KEY FK_A836BE99804C8213');
        $this->addSql('DROP TABLE vaccination_record');
        $this->addSql('DROP TABLE veterinarian');
    }
}
