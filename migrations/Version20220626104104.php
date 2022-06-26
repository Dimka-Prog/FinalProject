<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220626104104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rooms (id INT AUTO_INCREMENT NOT NULL, type_id_id INT NOT NULL, staff_id_id INT DEFAULT NULL, room_num INT NOT NULL, places INT NOT NULL, floor INT NOT NULL, room_status VARCHAR(45) NOT NULL, INDEX IDX_7CA11A96714819A0 (type_id_id), INDEX IDX_7CA11A962A13690 (staff_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rooms ADD CONSTRAINT FK_7CA11A96714819A0 FOREIGN KEY (type_id_id) REFERENCES room_type (id)');
        $this->addSql('ALTER TABLE rooms ADD CONSTRAINT FK_7CA11A962A13690 FOREIGN KEY (staff_id_id) REFERENCES hotel_staff (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE rooms');
    }
}
