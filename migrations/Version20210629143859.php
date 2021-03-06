<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210629143859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, group_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE main_password (id INT AUTO_INCREMENT NOT NULL, hash_password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE password (id INT AUTO_INCREMENT NOT NULL, sub_main_password_id INT NOT NULL, title VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, initialization_vector VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, INDEX IDX_35C246D54102377E (sub_main_password_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE password_group (password_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_8C5C89DA3E4A79C1 (password_id), INDEX IDX_8C5C89DAFE54D947 (group_id), PRIMARY KEY(password_id, group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_main_password (id INT AUTO_INCREMENT NOT NULL, groups_id INT NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_234D907EF373DCF (groups_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_8F02BF9DA76ED395 (user_id), INDEX IDX_8F02BF9DFE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE password ADD CONSTRAINT FK_35C246D54102377E FOREIGN KEY (sub_main_password_id) REFERENCES sub_main_password (id)');
        $this->addSql('ALTER TABLE password_group ADD CONSTRAINT FK_8C5C89DA3E4A79C1 FOREIGN KEY (password_id) REFERENCES password (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE password_group ADD CONSTRAINT FK_8C5C89DAFE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sub_main_password ADD CONSTRAINT FK_234D907EF373DCF FOREIGN KEY (groups_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DFE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE password_group DROP FOREIGN KEY FK_8C5C89DAFE54D947');
        $this->addSql('ALTER TABLE sub_main_password DROP FOREIGN KEY FK_234D907EF373DCF');
        $this->addSql('ALTER TABLE user_group DROP FOREIGN KEY FK_8F02BF9DFE54D947');
        $this->addSql('ALTER TABLE password_group DROP FOREIGN KEY FK_8C5C89DA3E4A79C1');
        $this->addSql('ALTER TABLE password DROP FOREIGN KEY FK_35C246D54102377E');
        $this->addSql('ALTER TABLE user_group DROP FOREIGN KEY FK_8F02BF9DA76ED395');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE main_password');
        $this->addSql('DROP TABLE password');
        $this->addSql('DROP TABLE password_group');
        $this->addSql('DROP TABLE sub_main_password');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_group');
    }
}
