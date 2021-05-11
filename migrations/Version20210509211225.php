<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210509211225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, userLogin VARCHAR(255) NOT NULL, INDEX IDX_BA388B74C6DD8C6 (userLogin), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_product (id INT AUTO_INCREMENT NOT NULL, cartId INT NOT NULL, productId INT NOT NULL, INDEX IDX_2890CCAA625A7B3C (cartId), INDEX IDX_2890CCAA36799605 (productId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE catalog (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, photo VARCHAR(510) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_product (id INT AUTO_INCREMENT NOT NULL, productId INT NOT NULL, orderId INT NOT NULL, INDEX IDX_2530ADE636799605 (productId), INDEX IDX_2530ADE6FA237437 (orderId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, creationDate DATETIME NOT NULL, cartId INT NOT NULL, INDEX IDX_E52FFDEE625A7B3C (cartId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', email VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, api_token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6497BA2F5EB (api_token), PRIMARY KEY(login)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B74C6DD8C6 FOREIGN KEY (userLogin) REFERENCES user (login)');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA625A7B3C FOREIGN KEY (cartId) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA36799605 FOREIGN KEY (productId) REFERENCES catalog (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE636799605 FOREIGN KEY (productId) REFERENCES catalog (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6FA237437 FOREIGN KEY (orderId) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE625A7B3C FOREIGN KEY (cartId) REFERENCES cart (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA625A7B3C');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE625A7B3C');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA36799605');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE636799605');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6FA237437');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B74C6DD8C6');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_product');
        $this->addSql('DROP TABLE catalog');
        $this->addSql('DROP TABLE order_product');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE user');
    }
}
