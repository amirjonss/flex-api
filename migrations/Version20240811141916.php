<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240811141916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add gym table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE gym_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE gym (id INT NOT NULL, gym_admin_id INT DEFAULT NULL, photo_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7F27DBED2A8B7380 ON gym (gym_admin_id)');
        $this->addSql('CREATE INDEX IDX_7F27DBED7E9E4C8C ON gym (photo_id)');
        $this->addSql('ALTER TABLE gym ADD CONSTRAINT FK_7F27DBED2A8B7380 FOREIGN KEY (gym_admin_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gym ADD CONSTRAINT FK_7F27DBED7E9E4C8C FOREIGN KEY (photo_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE gym_id_seq CASCADE');
        $this->addSql('ALTER TABLE gym DROP CONSTRAINT FK_7F27DBED2A8B7380');
        $this->addSql('ALTER TABLE gym DROP CONSTRAINT FK_7F27DBED7E9E4C8C');
        $this->addSql('DROP TABLE gym');
    }
}
