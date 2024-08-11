<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240811144017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add gym_subscription_purchase table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE gym_subscription_purchase_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE gym_subscription_purchase (id INT NOT NULL, user_id INT NOT NULL, gym_subscription_id INT NOT NULL, purchase_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BCF222FA67B3B43D ON gym_subscription_purchase (user_id)');
        $this->addSql('CREATE INDEX IDX_BCF222FAA0F28BC4 ON gym_subscription_purchase (gym_subscription_id)');
        $this->addSql('ALTER TABLE gym_subscription_purchase ADD CONSTRAINT FK_BCF222FA67B3B43D FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gym_subscription_purchase ADD CONSTRAINT FK_BCF222FAA0F28BC4 FOREIGN KEY (gym_subscription_id) REFERENCES gym_subscription (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE gym_subscription_purchase_id_seq CASCADE');
        $this->addSql('ALTER TABLE gym_subscription_purchase DROP CONSTRAINT FK_BCF222FA67B3B43D');
        $this->addSql('ALTER TABLE gym_subscription_purchase DROP CONSTRAINT FK_BCF222FAA0F28BC4');
        $this->addSql('DROP TABLE gym_subscription_purchase');
    }
}
