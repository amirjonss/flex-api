<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240811144404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add trainer_subscription_purchase table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE trainer_subscription_purchase_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE trainer_subscription_purchase (id INT NOT NULL, user_id INT NOT NULL, trainer_subscription_id INT NOT NULL, purchase_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DF05D2F767B3B43D ON trainer_subscription_purchase (user_id)');
        $this->addSql('CREATE INDEX IDX_DF05D2F7DDAC8264 ON trainer_subscription_purchase (trainer_subscription_id)');
        $this->addSql('ALTER TABLE trainer_subscription_purchase ADD CONSTRAINT FK_DF05D2F767B3B43D FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trainer_subscription_purchase ADD CONSTRAINT FK_DF05D2F7DDAC8264 FOREIGN KEY (trainer_subscription_id) REFERENCES trainer_subscription (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE trainer_subscription_purchase_id_seq CASCADE');
        $this->addSql('ALTER TABLE trainer_subscription_purchase DROP CONSTRAINT FK_DF05D2F767B3B43D');
        $this->addSql('ALTER TABLE trainer_subscription_purchase DROP CONSTRAINT FK_DF05D2F7DDAC8264');
        $this->addSql('DROP TABLE trainer_subscription_purchase');
    }
}
