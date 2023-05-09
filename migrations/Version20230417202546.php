<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230417202546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contacts ADD id INT AUTO_INCREMENT NOT NULL, ADD user_id_id INT NOT NULL, ADD contact_id_id INT NOT NULL, DROP userId, DROP contactId, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE contacts ADD CONSTRAINT FK_334015739D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE contacts ADD CONSTRAINT FK_33401573526E8E58 FOREIGN KEY (contact_id_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_334015739D86650F ON contacts (user_id_id)');
        $this->addSql('CREATE INDEX IDX_33401573526E8E58 ON contacts (contact_id_id)');
        $this->addSql('ALTER TABLE users CHANGE lastname lastname VARCHAR(255) NOT NULL, CHANGE firstname firstname VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE contacts MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE contacts DROP FOREIGN KEY FK_334015739D86650F');
        $this->addSql('ALTER TABLE contacts DROP FOREIGN KEY FK_33401573526E8E58');
        $this->addSql('DROP INDEX IDX_334015739D86650F ON contacts');
        $this->addSql('DROP INDEX IDX_33401573526E8E58 ON contacts');
        $this->addSql('DROP INDEX `primary` ON contacts');
        $this->addSql('ALTER TABLE contacts ADD userId INT NOT NULL, ADD contactId INT NOT NULL, DROP id, DROP user_id_id, DROP contact_id_id');
        $this->addSql('DROP INDEX UNIQ_1483A5E9E7927C74 ON users');
        $this->addSql('ALTER TABLE users CHANGE email email VARCHAR(100) NOT NULL, CHANGE password password TEXT NOT NULL, CHANGE lastname lastname TEXT NOT NULL, CHANGE firstname firstname TEXT NOT NULL');
    }
}
