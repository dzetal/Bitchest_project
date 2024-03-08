<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229164342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, has_wallet_id INT NOT NULL, name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, temporypassword VARCHAR(255) NOT NULL, solde NUMERIC(5, 2) NOT NULL, UNIQUE INDEX UNIQ_C74404555080B2BC (has_wallet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_transaction (client_id INT NOT NULL, transaction_id INT NOT NULL, INDEX IDX_737C20EA19EB6921 (client_id), INDEX IDX_737C20EA2FC0CB0F (transaction_id), PRIMARY KEY(client_id, transaction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crypto_currency (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, symbol VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, currentprice NUMERIC(5, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dashboard (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, crypto_currency_id INT NOT NULL, date DATETIME NOT NULL, quantity NUMERIC(5, 2) NOT NULL, purchaseprice NUMERIC(5, 2) NOT NULL, amount NUMERIC(5, 2) NOT NULL, INDEX IDX_723705D119932572 (crypto_currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, profil_picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wallet (id INT AUTO_INCREMENT NOT NULL, stop_id INT DEFAULT NULL, crypto_currency_id INT DEFAULT NULL, totalquantity NUMERIC(5, 2) NOT NULL, totalcost NUMERIC(5, 2) NOT NULL, actualcapitalgain NUMERIC(5, 2) NOT NULL, INDEX IDX_7C68921F3902063D (stop_id), INDEX IDX_7C68921F19932572 (crypto_currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404555080B2BC FOREIGN KEY (has_wallet_id) REFERENCES wallet (id)');
        $this->addSql('ALTER TABLE client_transaction ADD CONSTRAINT FK_737C20EA19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_transaction ADD CONSTRAINT FK_737C20EA2FC0CB0F FOREIGN KEY (transaction_id) REFERENCES transaction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D119932572 FOREIGN KEY (crypto_currency_id) REFERENCES crypto_currency (id)');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921F3902063D FOREIGN KEY (stop_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921F19932572 FOREIGN KEY (crypto_currency_id) REFERENCES crypto_currency (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404555080B2BC');
        $this->addSql('ALTER TABLE client_transaction DROP FOREIGN KEY FK_737C20EA19EB6921');
        $this->addSql('ALTER TABLE client_transaction DROP FOREIGN KEY FK_737C20EA2FC0CB0F');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D119932572');
        $this->addSql('ALTER TABLE wallet DROP FOREIGN KEY FK_7C68921F3902063D');
        $this->addSql('ALTER TABLE wallet DROP FOREIGN KEY FK_7C68921F19932572');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_transaction');
        $this->addSql('DROP TABLE crypto_currency');
        $this->addSql('DROP TABLE dashboard');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE wallet');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
