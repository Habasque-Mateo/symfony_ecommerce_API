<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210508154727 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY cart_ibfk_1');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY cart_ibfk_1');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B74C6DD8C6 FOREIGN KEY (userLogin) REFERENCES user (login)');
        $this->addSql('DROP INDEX userlogin ON cart');
        $this->addSql('CREATE INDEX IDX_BA388B74C6DD8C6 ON cart (userLogin)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT cart_ibfk_1 FOREIGN KEY (userLogin) REFERENCES user (login) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY cart_product_ibfk_1');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY cart_product_ibfk_2');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY cart_product_ibfk_1');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY cart_product_ibfk_2');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA625A7B3C FOREIGN KEY (cartId) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA36799605 FOREIGN KEY (productId) REFERENCES catalog (id)');
        $this->addSql('DROP INDEX cart_product_ibfk_1 ON cart_product');
        $this->addSql('CREATE INDEX IDX_2890CCAA625A7B3C ON cart_product (cartId)');
        $this->addSql('DROP INDEX cart_product_ibfk_2 ON cart_product');
        $this->addSql('CREATE INDEX IDX_2890CCAA36799605 ON cart_product (productId)');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT cart_product_ibfk_1 FOREIGN KEY (cartId) REFERENCES cart (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT cart_product_ibfk_2 FOREIGN KEY (productId) REFERENCES catalog (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY order_product_ibfk_1');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY order_product_ibfk_2');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY order_product_ibfk_1');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY order_product_ibfk_2');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE636799605 FOREIGN KEY (productId) REFERENCES catalog (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6FA237437 FOREIGN KEY (orderId) REFERENCES orders (id)');
        $this->addSql('DROP INDEX order_product_ibfk_1 ON order_product');
        $this->addSql('CREATE INDEX IDX_2530ADE636799605 ON order_product (productId)');
        $this->addSql('DROP INDEX order_product_ibfk_2 ON order_product');
        $this->addSql('CREATE INDEX IDX_2530ADE6FA237437 ON order_product (orderId)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT order_product_ibfk_1 FOREIGN KEY (productId) REFERENCES catalog (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT order_product_ibfk_2 FOREIGN KEY (orderId) REFERENCES orders (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY orders_ibfk_1');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY orders_ibfk_1');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE625A7B3C FOREIGN KEY (cartId) REFERENCES cart (id)');
        $this->addSql('DROP INDEX cartid ON orders');
        $this->addSql('CREATE INDEX IDX_E52FFDEE625A7B3C ON orders (cartId)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT orders_ibfk_1 FOREIGN KEY (cartId) REFERENCES cart (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD api_token VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6497BA2F5EB ON user (api_token)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B74C6DD8C6');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B74C6DD8C6');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT cart_ibfk_1 FOREIGN KEY (userLogin) REFERENCES user (login) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_ba388b74c6dd8c6 ON cart');
        $this->addSql('CREATE INDEX userLogin ON cart (userLogin)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B74C6DD8C6 FOREIGN KEY (userLogin) REFERENCES user (login)');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA625A7B3C');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA36799605');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA625A7B3C');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA36799605');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT cart_product_ibfk_1 FOREIGN KEY (cartId) REFERENCES cart (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT cart_product_ibfk_2 FOREIGN KEY (productId) REFERENCES catalog (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_2890ccaa625a7b3c ON cart_product');
        $this->addSql('CREATE INDEX cart_product_ibfk_1 ON cart_product (cartId)');
        $this->addSql('DROP INDEX idx_2890ccaa36799605 ON cart_product');
        $this->addSql('CREATE INDEX cart_product_ibfk_2 ON cart_product (productId)');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA625A7B3C FOREIGN KEY (cartId) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA36799605 FOREIGN KEY (productId) REFERENCES catalog (id)');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE636799605');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6FA237437');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE636799605');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6FA237437');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT order_product_ibfk_1 FOREIGN KEY (productId) REFERENCES catalog (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT order_product_ibfk_2 FOREIGN KEY (orderId) REFERENCES orders (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_2530ade636799605 ON order_product');
        $this->addSql('CREATE INDEX order_product_ibfk_1 ON order_product (productId)');
        $this->addSql('DROP INDEX idx_2530ade6fa237437 ON order_product');
        $this->addSql('CREATE INDEX order_product_ibfk_2 ON order_product (orderId)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE636799605 FOREIGN KEY (productId) REFERENCES catalog (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6FA237437 FOREIGN KEY (orderId) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE625A7B3C');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE625A7B3C');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT orders_ibfk_1 FOREIGN KEY (cartId) REFERENCES cart (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_e52ffdee625a7b3c ON orders');
        $this->addSql('CREATE INDEX cartId ON orders (cartId)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE625A7B3C FOREIGN KEY (cartId) REFERENCES cart (id)');
        $this->addSql('DROP INDEX UNIQ_8D93D6497BA2F5EB ON user');
        $this->addSql('ALTER TABLE user DROP roles, DROP api_token');
    }
}
