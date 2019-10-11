<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190920130856 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_F557830186813830');
        $this->addSql('DROP INDEX IDX_F557830159D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__kitchen_tools_recipe AS SELECT kitchen_tools_id, recipe_id FROM kitchen_tools_recipe');
        $this->addSql('DROP TABLE kitchen_tools_recipe');
        $this->addSql('CREATE TABLE kitchen_tools_recipe (kitchen_tools_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(kitchen_tools_id, recipe_id), CONSTRAINT FK_F557830186813830 FOREIGN KEY (kitchen_tools_id) REFERENCES kitchen_tools (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F557830159D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO kitchen_tools_recipe (kitchen_tools_id, recipe_id) SELECT kitchen_tools_id, recipe_id FROM __temp__kitchen_tools_recipe');
        $this->addSql('DROP TABLE __temp__kitchen_tools_recipe');
        $this->addSql('CREATE INDEX IDX_F557830186813830 ON kitchen_tools_recipe (kitchen_tools_id)');
        $this->addSql('CREATE INDEX IDX_F557830159D8A214 ON kitchen_tools_recipe (recipe_id)');
        $this->addSql('ALTER TABLE user ADD COLUMN name VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_36F2717659D8A214');
        $this->addSql('DROP INDEX IDX_36F27176933FE08C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient_recipe AS SELECT ingredient_id, recipe_id FROM ingredient_recipe');
        $this->addSql('DROP TABLE ingredient_recipe');
        $this->addSql('CREATE TABLE ingredient_recipe (ingredient_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(ingredient_id, recipe_id), CONSTRAINT FK_36F27176933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_36F2717659D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ingredient_recipe (ingredient_id, recipe_id) SELECT ingredient_id, recipe_id FROM __temp__ingredient_recipe');
        $this->addSql('DROP TABLE __temp__ingredient_recipe');
        $this->addSql('CREATE INDEX IDX_36F2717659D8A214 ON ingredient_recipe (recipe_id)');
        $this->addSql('CREATE INDEX IDX_36F27176933FE08C ON ingredient_recipe (ingredient_id)');
        $this->addSql('DROP INDEX IDX_43B9FE3CFDF2B1FA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__step AS SELECT id, recipes_id, spot, description FROM step');
        $this->addSql('DROP TABLE step');
        $this->addSql('CREATE TABLE step (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipes_id INTEGER DEFAULT NULL, spot INTEGER NOT NULL, description CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_43B9FE3CFDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO step (id, recipes_id, spot, description) SELECT id, recipes_id, spot, description FROM __temp__step');
        $this->addSql('DROP TABLE __temp__step');
        $this->addSql('CREATE INDEX IDX_43B9FE3CFDF2B1FA ON step (recipes_id)');
        $this->addSql('DROP INDEX IDX_5F9E962AFDF2B1FA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comments AS SELECT id, recipes_id, author, message FROM comments');
        $this->addSql('DROP TABLE comments');
        $this->addSql('CREATE TABLE comments (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipes_id INTEGER DEFAULT NULL, author VARCHAR(255) NOT NULL COLLATE BINARY, message CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_5F9E962AFDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO comments (id, recipes_id, author, message) SELECT id, recipes_id, author, message FROM __temp__comments');
        $this->addSql('DROP TABLE __temp__comments');
        $this->addSql('CREATE INDEX IDX_5F9E962AFDF2B1FA ON comments (recipes_id)');
        $this->addSql('DROP INDEX IDX_E9B074493EC4DCE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__units AS SELECT id, ingredients_id, name FROM units');
        $this->addSql('DROP TABLE units');
        $this->addSql('CREATE TABLE units (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ingredients_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_E9B074493EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredient (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO units (id, ingredients_id, name) SELECT id, ingredients_id, name FROM __temp__units');
        $this->addSql('DROP TABLE __temp__units');
        $this->addSql('CREATE INDEX IDX_E9B074493EC4DCE ON units (ingredients_id)');
        $this->addSql('DROP INDEX IDX_33C9F81B59D8A214');
        $this->addSql('DROP INDEX IDX_33C9F81BBAD26311');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tag_recipe AS SELECT tag_id, recipe_id FROM tag_recipe');
        $this->addSql('DROP TABLE tag_recipe');
        $this->addSql('CREATE TABLE tag_recipe (tag_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(tag_id, recipe_id), CONSTRAINT FK_33C9F81BBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_33C9F81B59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tag_recipe (tag_id, recipe_id) SELECT tag_id, recipe_id FROM __temp__tag_recipe');
        $this->addSql('DROP TABLE __temp__tag_recipe');
        $this->addSql('CREATE INDEX IDX_33C9F81B59D8A214 ON tag_recipe (recipe_id)');
        $this->addSql('CREATE INDEX IDX_33C9F81BBAD26311 ON tag_recipe (tag_id)');
        $this->addSql('DROP INDEX IDX_6970EB0FFDF2B1FA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reviews AS SELECT id, recipes_id, username, commentary FROM reviews');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('CREATE TABLE reviews (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipes_id INTEGER DEFAULT NULL, username VARCHAR(255) NOT NULL COLLATE BINARY, commentary CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_6970EB0FFDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO reviews (id, recipes_id, username, commentary) SELECT id, recipes_id, username, commentary FROM __temp__reviews');
        $this->addSql('DROP TABLE __temp__reviews');
        $this->addSql('CREATE INDEX IDX_6970EB0FFDF2B1FA ON reviews (recipes_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_5F9E962AFDF2B1FA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comments AS SELECT id, recipes_id, author, message FROM comments');
        $this->addSql('DROP TABLE comments');
        $this->addSql('CREATE TABLE comments (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipes_id INTEGER DEFAULT NULL, author VARCHAR(255) NOT NULL, message CLOB NOT NULL)');
        $this->addSql('INSERT INTO comments (id, recipes_id, author, message) SELECT id, recipes_id, author, message FROM __temp__comments');
        $this->addSql('DROP TABLE __temp__comments');
        $this->addSql('CREATE INDEX IDX_5F9E962AFDF2B1FA ON comments (recipes_id)');
        $this->addSql('DROP INDEX IDX_36F27176933FE08C');
        $this->addSql('DROP INDEX IDX_36F2717659D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient_recipe AS SELECT ingredient_id, recipe_id FROM ingredient_recipe');
        $this->addSql('DROP TABLE ingredient_recipe');
        $this->addSql('CREATE TABLE ingredient_recipe (ingredient_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(ingredient_id, recipe_id))');
        $this->addSql('INSERT INTO ingredient_recipe (ingredient_id, recipe_id) SELECT ingredient_id, recipe_id FROM __temp__ingredient_recipe');
        $this->addSql('DROP TABLE __temp__ingredient_recipe');
        $this->addSql('CREATE INDEX IDX_36F27176933FE08C ON ingredient_recipe (ingredient_id)');
        $this->addSql('CREATE INDEX IDX_36F2717659D8A214 ON ingredient_recipe (recipe_id)');
        $this->addSql('DROP INDEX IDX_F557830186813830');
        $this->addSql('DROP INDEX IDX_F557830159D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__kitchen_tools_recipe AS SELECT kitchen_tools_id, recipe_id FROM kitchen_tools_recipe');
        $this->addSql('DROP TABLE kitchen_tools_recipe');
        $this->addSql('CREATE TABLE kitchen_tools_recipe (kitchen_tools_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(kitchen_tools_id, recipe_id))');
        $this->addSql('INSERT INTO kitchen_tools_recipe (kitchen_tools_id, recipe_id) SELECT kitchen_tools_id, recipe_id FROM __temp__kitchen_tools_recipe');
        $this->addSql('DROP TABLE __temp__kitchen_tools_recipe');
        $this->addSql('CREATE INDEX IDX_F557830186813830 ON kitchen_tools_recipe (kitchen_tools_id)');
        $this->addSql('CREATE INDEX IDX_F557830159D8A214 ON kitchen_tools_recipe (recipe_id)');
        $this->addSql('DROP INDEX IDX_6970EB0FFDF2B1FA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reviews AS SELECT id, recipes_id, username, commentary FROM reviews');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('CREATE TABLE reviews (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipes_id INTEGER DEFAULT NULL, username VARCHAR(255) NOT NULL, commentary CLOB NOT NULL)');
        $this->addSql('INSERT INTO reviews (id, recipes_id, username, commentary) SELECT id, recipes_id, username, commentary FROM __temp__reviews');
        $this->addSql('DROP TABLE __temp__reviews');
        $this->addSql('CREATE INDEX IDX_6970EB0FFDF2B1FA ON reviews (recipes_id)');
        $this->addSql('DROP INDEX IDX_43B9FE3CFDF2B1FA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__step AS SELECT id, recipes_id, spot, description FROM step');
        $this->addSql('DROP TABLE step');
        $this->addSql('CREATE TABLE step (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipes_id INTEGER DEFAULT NULL, spot INTEGER NOT NULL, description CLOB NOT NULL)');
        $this->addSql('INSERT INTO step (id, recipes_id, spot, description) SELECT id, recipes_id, spot, description FROM __temp__step');
        $this->addSql('DROP TABLE __temp__step');
        $this->addSql('CREATE INDEX IDX_43B9FE3CFDF2B1FA ON step (recipes_id)');
        $this->addSql('DROP INDEX IDX_33C9F81BBAD26311');
        $this->addSql('DROP INDEX IDX_33C9F81B59D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tag_recipe AS SELECT tag_id, recipe_id FROM tag_recipe');
        $this->addSql('DROP TABLE tag_recipe');
        $this->addSql('CREATE TABLE tag_recipe (tag_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(tag_id, recipe_id))');
        $this->addSql('INSERT INTO tag_recipe (tag_id, recipe_id) SELECT tag_id, recipe_id FROM __temp__tag_recipe');
        $this->addSql('DROP TABLE __temp__tag_recipe');
        $this->addSql('CREATE INDEX IDX_33C9F81BBAD26311 ON tag_recipe (tag_id)');
        $this->addSql('CREATE INDEX IDX_33C9F81B59D8A214 ON tag_recipe (recipe_id)');
        $this->addSql('DROP INDEX IDX_E9B074493EC4DCE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__units AS SELECT id, ingredients_id, name FROM units');
        $this->addSql('DROP TABLE units');
        $this->addSql('CREATE TABLE units (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ingredients_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO units (id, ingredients_id, name) SELECT id, ingredients_id, name FROM __temp__units');
        $this->addSql('DROP TABLE __temp__units');
        $this->addSql('CREATE INDEX IDX_E9B074493EC4DCE ON units (ingredients_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, picture FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, password, picture) SELECT id, email, roles, password, picture FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }
}
