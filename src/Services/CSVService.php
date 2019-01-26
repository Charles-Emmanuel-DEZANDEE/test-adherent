<?php
/**
 * Created by PhpStorm.
 * User: charles-emmanuel
 * Date: 2019-01-24
 * Time: 23:51
 * auteur: Charles-emmanuel DEZANDEE  <cdezandee@gmail.com>
 */

namespace App\Services;


use Symfony\Component\Filesystem\Filesystem;

class CSVService
{

    const PATHCSV = __DIR__.'/../../src/data/data.csv';

    /**
     * @var array|bool
     */
    private $dataCSV;

    /**
     * CSVService constructor.
     */
    public function __construct()
    {
        if ($this->CSVExist()){
            $this->dataCSV = $this->csv_to_array(self::PATHCSV, ';');
        }
    }

    /**
     * converti un csv en tableau associatif
     *
     * @param string $filename
     * @param string $delimiter
     * @return array
     * auteur : Charles-emmanuel DEZANDEE  <cdezandee@gmail.com>
     */
    protected function csv_to_array($filename='', $delimiter=',')
    {
        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            $cpt = 0;
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if(!$header){
                    $header = $row;
                }
                else {
                    $data[$cpt] = array_combine($header, $row);
                }
                $cpt++;
            }
            fclose($handle);

            // on trie le tableau par ordre alphabétique
            $nom = array_column($data, 'nom');
            $prenom = array_column($data, 'prenom');
            array_multisort($nom, SORT_ASC, $prenom,SORT_ASC, $data );

            // on met l'identifiant comme clef da tableau associatif principale pour facilité la recherche
            $temp = [];
            foreach ($data as $ligne) {
                $temp[strval($ligne['identifiant'])] = $ligne;
            }

            $data = $temp;
        }

        return $data;
    }

    /**
     * Test si le fichier CSV existe
     *
     * @return bool
     * auteur : Charles-emmanuel DEZANDEE  <cdezandee@gmail.com>
     */
    public function CSVExist() {
        $fileSystem = new Filesystem();
        return $fileSystem->exists(self::PATHCSV);
    }

    /**
     * On compte le nombre de ligne du CSV
     * le CSV est vide s'il y 0 ou 1 lignes
     *
     * @return bool
     * auteur : Charles-emmanuel DEZANDEE  <cdezandee@gmail.com>
     */
    public function  CSVEmpty (){
        return count($this->dataCSV) > 0;
    }

    /**
     * retourne un élément du tableau issu CVS sous forme de tableau ou null si la ligne n'existe pas
     *
     * @param $ligneNumbre
     * @return array|null
     * auteur : Charles-emmanuel DEZANDEE  <cdezandee@gmail.com>
     */
    public function getOneRow ($ligneNumber) {
        $return = null;
        $tring = strval($ligneNumber);
        if (key_exists($tring, $this->dataCSV)){
            $return = $this->dataCSV[$tring];
        }
        return $return;
    }

    /**
     * retourne le csv sous forme de tableau
     *
     * @return |null
     * auteur : Charles-emmanuel DEZANDEE  <cdezandee@gmail.com>
     */
    public function getAllRows () {
        return $this->dataCSV;
    }

}
