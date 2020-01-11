<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200109022832 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE roles ADD role_id INT NOT NULL');
        $this->addSql('ALTER TABLE roles ADD CONSTRAINT FK_B63E2EC7D60322AC FOREIGN KEY (role_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B63E2EC7D60322AC ON roles (role_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE roles DROP FOREIGN KEY FK_B63E2EC7D60322AC');
        $this->addSql('DROP INDEX UNIQ_B63E2EC7D60322AC ON roles');
        $this->addSql('ALTER TABLE roles DROP role_id');
    }
}
