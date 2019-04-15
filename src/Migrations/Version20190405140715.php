<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190405140715 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pro_profil (id INT AUTO_INCREMENT NOT NULL, nom_entreprise VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, ville VARCHAR(255) DEFAULT NULL, codepostal INT DEFAULT NULL, adresse LONGTEXT DEFAULT NULL, telephone INT DEFAULT NULL, password VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, nombre_personnel INT DEFAULT NULL, disponibilite TINYINT(1) NOT NULL, tarif NUMERIC(10, 10) DEFAULT NULL, horaire JSON DEFAULT NULL, statut TINYINT(1) NOT NULL, nombredeplace INT NOT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_40D43EC0C567A17 (nom_entreprise), UNIQUE INDEX UNIQ_40D43EC05126AC48 (mail), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tuteur (id INT AUTO_INCREMENT NOT NULL, parentt_id INT DEFAULT NULL, pro_profil_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_564122682AD18E6A (parentt_id), INDEX IDX_5641226837955E80 (pro_profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tuteur ADD CONSTRAINT FK_564122682AD18E6A FOREIGN KEY (parentt_id) REFERENCES parentt (id)');
        $this->addSql('ALTER TABLE tuteur ADD CONSTRAINT FK_5641226837955E80 FOREIGN KEY (pro_profil_id) REFERENCES pro_profil (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF02AD18E6A FOREIGN KEY (parentt_id) REFERENCES parentt (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF037955E80 FOREIGN KEY (pro_profil_id) REFERENCES pro_profil (id)');
        $this->addSql('ALTER TABLE enfant_profil ADD CONSTRAINT FK_65BDECDA2AD18E6A FOREIGN KEY (parentt_id) REFERENCES parentt (id)');
        $this->addSql('ALTER TABLE facturation ADD CONSTRAINT FK_17EB513A2AD18E6A FOREIGN KEY (parentt_id) REFERENCES parentt (id)');
        $this->addSql('ALTER TABLE facturation ADD CONSTRAINT FK_17EB513A37955E80 FOREIGN KEY (pro_profil_id) REFERENCES pro_profil (id)');
        $this->addSql('ALTER TABLE liste_status ADD CONSTRAINT FK_4A7110272AD18E6A FOREIGN KEY (parentt_id) REFERENCES parentt (id)');
        $this->addSql('ALTER TABLE liste_status ADD CONSTRAINT FK_4A71102737955E80 FOREIGN KEY (pro_profil_id) REFERENCES pro_profil (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E2AD18E6A FOREIGN KEY (parentt_id) REFERENCES parentt (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E37955E80 FOREIGN KEY (pro_profil_id) REFERENCES pro_profil (id)');
        $this->addSql('ALTER TABLE parentt ADD roles JSON NOT NULL, ADD statutcondition TINYINT(1) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_633488C95126AC48 ON parentt (mail)');
        $this->addSql('ALTER TABLE plan ADD CONSTRAINT FK_DD5A5B7DA1440662 FOREIGN KEY (enfant_profil_id) REFERENCES enfant_profil (id)');
        $this->addSql('ALTER TABLE plan ADD CONSTRAINT FK_DD5A5B7D37955E80 FOREIGN KEY (pro_profil_id) REFERENCES pro_profil (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF037955E80');
        $this->addSql('ALTER TABLE facturation DROP FOREIGN KEY FK_17EB513A37955E80');
        $this->addSql('ALTER TABLE liste_status DROP FOREIGN KEY FK_4A71102737955E80');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E37955E80');
        $this->addSql('ALTER TABLE plan DROP FOREIGN KEY FK_DD5A5B7D37955E80');
        $this->addSql('ALTER TABLE tuteur DROP FOREIGN KEY FK_5641226837955E80');
        $this->addSql('DROP TABLE pro_profil');
        $this->addSql('DROP TABLE tuteur');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF02AD18E6A');
        $this->addSql('ALTER TABLE enfant_profil DROP FOREIGN KEY FK_65BDECDA2AD18E6A');
        $this->addSql('ALTER TABLE facturation DROP FOREIGN KEY FK_17EB513A2AD18E6A');
        $this->addSql('ALTER TABLE liste_status DROP FOREIGN KEY FK_4A7110272AD18E6A');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E2AD18E6A');
        $this->addSql('DROP INDEX UNIQ_633488C95126AC48 ON parentt');
        $this->addSql('ALTER TABLE parentt DROP roles, DROP statutcondition');
        $this->addSql('ALTER TABLE plan DROP FOREIGN KEY FK_DD5A5B7DA1440662');
    }
}
