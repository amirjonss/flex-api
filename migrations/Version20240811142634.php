<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240811142634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add trainer table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE trainer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE trainer (id INT NOT NULL, gym_id INT NOT NULL, user_id INT NOT NULL, photo_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) DEFAULT NULL, specialization VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C5150820BD2F03 ON trainer (gym_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C515082067B3B43D ON trainer (user_id)');
        $this->addSql('CREATE INDEX IDX_C51508207E9E4C8C ON trainer (photo_id)');
        $this->addSql('ALTER TABLE trainer ADD CONSTRAINT FK_C5150820BD2F03 FOREIGN KEY (gym_id) REFERENCES gym (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trainer ADD CONSTRAINT FK_C515082067B3B43D FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trainer ADD CONSTRAINT FK_C51508207E9E4C8C FOREIGN KEY (photo_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE trainer_id_seq CASCADE');
        $this->addSql('ALTER TABLE trainer DROP CONSTRAINT FK_C5150820BD2F03');
        $this->addSql('ALTER TABLE trainer DROP CONSTRAINT FK_C515082067B3B43D');
        $this->addSql('ALTER TABLE trainer DROP CONSTRAINT FK_C51508207E9E4C8C');
        $this->addSql('DROP TABLE trainer');
    }
}
