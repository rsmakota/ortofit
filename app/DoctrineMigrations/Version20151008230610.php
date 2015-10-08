<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151008230610 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE results_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE quizzes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE questions_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE variants_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE countries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE applications_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE clients_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE results (id INT NOT NULL, quiz_id INT DEFAULT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9FA3E414853CD175 ON results (quiz_id)');
        $this->addSql('CREATE TABLE result_variants (result_id INT NOT NULL, variant_id INT NOT NULL, PRIMARY KEY(result_id, variant_id))');
        $this->addSql('CREATE INDEX IDX_149D4C027A7B643 ON result_variants (result_id)');
        $this->addSql('CREATE INDEX IDX_149D4C023B69A9AF ON result_variants (variant_id)');
        $this->addSql('CREATE TABLE quizzes (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, start_template VARCHAR(255) NOT NULL, result_template VARCHAR(255) NOT NULL, result_manager_id VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE questions (id INT NOT NULL, quiz_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, index INT NOT NULL, position VARCHAR(255) NOT NULL, template VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8ADC54D5853CD175 ON questions (quiz_id)');
        $this->addSql('CREATE TABLE variants (id INT NOT NULL, question_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, index INT NOT NULL, positive BOOLEAN NOT NULL, result VARCHAR(255) DEFAULT NULL, recommendation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B39853E11E27F6BF ON variants (question_id)');
        $this->addSql('CREATE TABLE countries (id INT NOT NULL, name VARCHAR(255) NOT NULL, prefix VARCHAR(4) NOT NULL, pattern VARCHAR(255) NOT NULL, iso2 VARCHAR(2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE applications (id INT NOT NULL, client_id INT DEFAULT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F7C966F019EB6921 ON applications (client_id)');
        $this->addSql('CREATE TABLE clients (id INT NOT NULL, country_id INT DEFAULT NULL, msisdn VARCHAR(255) NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C82E74F92F3E70 ON clients (country_id)');
        $this->addSql('ALTER TABLE results ADD CONSTRAINT FK_9FA3E414853CD175 FOREIGN KEY (quiz_id) REFERENCES quizzes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE result_variants ADD CONSTRAINT FK_149D4C027A7B643 FOREIGN KEY (result_id) REFERENCES results (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE result_variants ADD CONSTRAINT FK_149D4C023B69A9AF FOREIGN KEY (variant_id) REFERENCES variants (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D5853CD175 FOREIGN KEY (quiz_id) REFERENCES quizzes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE variants ADD CONSTRAINT FK_B39853E11E27F6BF FOREIGN KEY (question_id) REFERENCES questions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE applications ADD CONSTRAINT FK_F7C966F019EB6921 FOREIGN KEY (client_id) REFERENCES clients (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E74F92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE result_variants DROP CONSTRAINT FK_149D4C027A7B643');
        $this->addSql('ALTER TABLE results DROP CONSTRAINT FK_9FA3E414853CD175');
        $this->addSql('ALTER TABLE questions DROP CONSTRAINT FK_8ADC54D5853CD175');
        $this->addSql('ALTER TABLE variants DROP CONSTRAINT FK_B39853E11E27F6BF');
        $this->addSql('ALTER TABLE result_variants DROP CONSTRAINT FK_149D4C023B69A9AF');
        $this->addSql('ALTER TABLE clients DROP CONSTRAINT FK_C82E74F92F3E70');
        $this->addSql('ALTER TABLE applications DROP CONSTRAINT FK_F7C966F019EB6921');
        $this->addSql('DROP SEQUENCE results_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE quizzes_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE questions_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE variants_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE countries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE applications_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE clients_id_seq CASCADE');
        $this->addSql('DROP TABLE results');
        $this->addSql('DROP TABLE result_variants');
        $this->addSql('DROP TABLE quizzes');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE variants');
        $this->addSql('DROP TABLE countries');
        $this->addSql('DROP TABLE applications');
        $this->addSql('DROP TABLE clients');
    }
}
