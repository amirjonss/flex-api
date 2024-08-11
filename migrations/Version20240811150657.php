<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240811150657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add createdAt, updatedAt, deletedAt columns to tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gym ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gym ADD deleted_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gym ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE gym ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE gym ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE gym ADD CONSTRAINT FK_7F27DBED896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gym ADD CONSTRAINT FK_7F27DBEDC76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7F27DBED896DBBDE ON gym (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_7F27DBEDC76F1F52 ON gym (deleted_by_id)');
        $this->addSql('ALTER TABLE gym_subscription ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gym_subscription ADD deleted_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gym_subscription ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE gym_subscription ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE gym_subscription ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE gym_subscription ADD CONSTRAINT FK_95E34CEE896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gym_subscription ADD CONSTRAINT FK_95E34CEEC76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_95E34CEE896DBBDE ON gym_subscription (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_95E34CEEC76F1F52 ON gym_subscription (deleted_by_id)');
        $this->addSql('ALTER TABLE gym_subscription_purchase ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gym_subscription_purchase ADD deleted_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gym_subscription_purchase ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE gym_subscription_purchase ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE gym_subscription_purchase ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE gym_subscription_purchase ADD CONSTRAINT FK_BCF222FA896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gym_subscription_purchase ADD CONSTRAINT FK_BCF222FAC76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BCF222FA896DBBDE ON gym_subscription_purchase (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_BCF222FAC76F1F52 ON gym_subscription_purchase (deleted_by_id)');
        $this->addSql('ALTER INDEX idx_bcf222fa67b3b43d RENAME TO IDX_BCF222FAA76ED395');
        $this->addSql('ALTER TABLE trainer ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trainer ADD deleted_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trainer ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE trainer ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE trainer ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE trainer ADD CONSTRAINT FK_C5150820896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trainer ADD CONSTRAINT FK_C5150820C76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C5150820896DBBDE ON trainer (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_C5150820C76F1F52 ON trainer (deleted_by_id)');
        $this->addSql('ALTER INDEX uniq_c515082067b3b43d RENAME TO UNIQ_C5150820A76ED395');
        $this->addSql('ALTER TABLE trainer_subscription ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trainer_subscription ADD deleted_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trainer_subscription ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE trainer_subscription ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE trainer_subscription ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE trainer_subscription ADD CONSTRAINT FK_DD8961D896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trainer_subscription ADD CONSTRAINT FK_DD8961DC76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DD8961D896DBBDE ON trainer_subscription (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_DD8961DC76F1F52 ON trainer_subscription (deleted_by_id)');
        $this->addSql('ALTER TABLE trainer_subscription_purchase ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trainer_subscription_purchase ADD deleted_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trainer_subscription_purchase ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE trainer_subscription_purchase ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE trainer_subscription_purchase ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE trainer_subscription_purchase ADD CONSTRAINT FK_DF05D2F7896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trainer_subscription_purchase ADD CONSTRAINT FK_DF05D2F7C76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DF05D2F7896DBBDE ON trainer_subscription_purchase (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_DF05D2F7C76F1F52 ON trainer_subscription_purchase (deleted_by_id)');
        $this->addSql('ALTER INDEX idx_df05d2f767b3b43d RENAME TO IDX_DF05D2F7A76ED395');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE gym DROP CONSTRAINT FK_7F27DBED896DBBDE');
        $this->addSql('ALTER TABLE gym DROP CONSTRAINT FK_7F27DBEDC76F1F52');
        $this->addSql('DROP INDEX IDX_7F27DBED896DBBDE');
        $this->addSql('DROP INDEX IDX_7F27DBEDC76F1F52');
        $this->addSql('ALTER TABLE gym DROP updated_by_id');
        $this->addSql('ALTER TABLE gym DROP deleted_by_id');
        $this->addSql('ALTER TABLE gym DROP created_at');
        $this->addSql('ALTER TABLE gym DROP updated_at');
        $this->addSql('ALTER TABLE gym DROP deleted_at');
        $this->addSql('ALTER TABLE trainer DROP CONSTRAINT FK_C5150820896DBBDE');
        $this->addSql('ALTER TABLE trainer DROP CONSTRAINT FK_C5150820C76F1F52');
        $this->addSql('DROP INDEX IDX_C5150820896DBBDE');
        $this->addSql('DROP INDEX IDX_C5150820C76F1F52');
        $this->addSql('ALTER TABLE trainer DROP updated_by_id');
        $this->addSql('ALTER TABLE trainer DROP deleted_by_id');
        $this->addSql('ALTER TABLE trainer DROP created_at');
        $this->addSql('ALTER TABLE trainer DROP updated_at');
        $this->addSql('ALTER TABLE trainer DROP deleted_at');
        $this->addSql('ALTER INDEX uniq_c5150820a76ed395 RENAME TO uniq_c515082067b3b43d');
        $this->addSql('ALTER TABLE gym_subscription DROP CONSTRAINT FK_95E34CEE896DBBDE');
        $this->addSql('ALTER TABLE gym_subscription DROP CONSTRAINT FK_95E34CEEC76F1F52');
        $this->addSql('DROP INDEX IDX_95E34CEE896DBBDE');
        $this->addSql('DROP INDEX IDX_95E34CEEC76F1F52');
        $this->addSql('ALTER TABLE gym_subscription DROP updated_by_id');
        $this->addSql('ALTER TABLE gym_subscription DROP deleted_by_id');
        $this->addSql('ALTER TABLE gym_subscription DROP created_at');
        $this->addSql('ALTER TABLE gym_subscription DROP updated_at');
        $this->addSql('ALTER TABLE gym_subscription DROP deleted_at');
        $this->addSql('ALTER TABLE trainer_subscription DROP CONSTRAINT FK_DD8961D896DBBDE');
        $this->addSql('ALTER TABLE trainer_subscription DROP CONSTRAINT FK_DD8961DC76F1F52');
        $this->addSql('DROP INDEX IDX_DD8961D896DBBDE');
        $this->addSql('DROP INDEX IDX_DD8961DC76F1F52');
        $this->addSql('ALTER TABLE trainer_subscription DROP updated_by_id');
        $this->addSql('ALTER TABLE trainer_subscription DROP deleted_by_id');
        $this->addSql('ALTER TABLE trainer_subscription DROP created_at');
        $this->addSql('ALTER TABLE trainer_subscription DROP updated_at');
        $this->addSql('ALTER TABLE trainer_subscription DROP deleted_at');
        $this->addSql('ALTER TABLE gym_subscription_purchase DROP CONSTRAINT FK_BCF222FA896DBBDE');
        $this->addSql('ALTER TABLE gym_subscription_purchase DROP CONSTRAINT FK_BCF222FAC76F1F52');
        $this->addSql('DROP INDEX IDX_BCF222FA896DBBDE');
        $this->addSql('DROP INDEX IDX_BCF222FAC76F1F52');
        $this->addSql('ALTER TABLE gym_subscription_purchase DROP updated_by_id');
        $this->addSql('ALTER TABLE gym_subscription_purchase DROP deleted_by_id');
        $this->addSql('ALTER TABLE gym_subscription_purchase DROP created_at');
        $this->addSql('ALTER TABLE gym_subscription_purchase DROP updated_at');
        $this->addSql('ALTER TABLE gym_subscription_purchase DROP deleted_at');
        $this->addSql('ALTER INDEX idx_bcf222faa76ed395 RENAME TO idx_bcf222fa67b3b43d');
        $this->addSql('ALTER TABLE trainer_subscription_purchase DROP CONSTRAINT FK_DF05D2F7896DBBDE');
        $this->addSql('ALTER TABLE trainer_subscription_purchase DROP CONSTRAINT FK_DF05D2F7C76F1F52');
        $this->addSql('DROP INDEX IDX_DF05D2F7896DBBDE');
        $this->addSql('DROP INDEX IDX_DF05D2F7C76F1F52');
        $this->addSql('ALTER TABLE trainer_subscription_purchase DROP updated_by_id');
        $this->addSql('ALTER TABLE trainer_subscription_purchase DROP deleted_by_id');
        $this->addSql('ALTER TABLE trainer_subscription_purchase DROP created_at');
        $this->addSql('ALTER TABLE trainer_subscription_purchase DROP updated_at');
        $this->addSql('ALTER TABLE trainer_subscription_purchase DROP deleted_at');
        $this->addSql('ALTER INDEX idx_df05d2f7a76ed395 RENAME TO idx_df05d2f767b3b43d');
    }
}
