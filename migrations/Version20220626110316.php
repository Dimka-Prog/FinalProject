<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220626110316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE settling_room (id INT AUTO_INCREMENT NOT NULL, room_num_id INT NOT NULL, passport_num_id INT NOT NULL, set_date DATETIME NOT NULL, departure_date DATETIME DEFAULT NULL, INDEX IDX_5BF15EA4A30C550B (room_num_id), UNIQUE INDEX UNIQ_5BF15EA43A2B265A (passport_num_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE settling_room ADD CONSTRAINT FK_5BF15EA4A30C550B FOREIGN KEY (room_num_id) REFERENCES rooms (id)');
        $this->addSql('ALTER TABLE settling_room ADD CONSTRAINT FK_5BF15EA43A2B265A FOREIGN KEY (passport_num_id) REFERENCES guests (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE settling_room');
    }
}
