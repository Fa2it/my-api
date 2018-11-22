<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181121195219 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) DEFAULT NULL, supplier_id INT NOT NULL, category_id INT NOT NULL, description VARCHAR(255) NOT NULL, unit_price DOUBLE PRECISION NOT NULL, creation_date VARCHAR(40) NOT NULL, last_modified_date VARCHAR(40) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE sessions');
        $this->addSql('DROP INDEX email ON user');
        $this->addSql('DROP INDEX name ON user');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sessions (sess_id VARCHAR(128) NOT NULL COLLATE utf8_bin, sess_data BLOB NOT NULL, sess_time INT UNSIGNED NOT NULL, sess_lifetime INT NOT NULL, PRIMARY KEY(sess_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE UNIQUE INDEX email ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX name ON user (name)');
    }
}
