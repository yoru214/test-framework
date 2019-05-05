<?php
/**
 * Customer.php
 * PHP Version 7.2.10
 * 
 * @category Model
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
namespace Model;
/**
 * Customer Class
 * PHP Version 7.2.10
 * 
 * @category Model
 * @package  MyStore
 * @author   Emmanuel Zerna <emzer214@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/yoru214/test-framework
 */
class Customer extends AppModel
{
    /**
     * Add Customer and Auto Login
     *
     * @return object 
     */
    public function add()
    {
        $name = $this->setname();
        $sql = "insert into customers (name) values('".$name."')";
        $this->query($sql);
        $args = array('conditions'=> array('name'=>$name));
        return $this->find($args);

    }
    /**
     * Set the funds of the currently logged user.
     *
     * @return void
     */
    public function setFunds()
    {
        $sql  = "SELECT ";
        $sql .= "c.id, ";
        $sql .= "(c.`funds` - SUM(IFNULL((p.price * p.quantity),0))) AS 'funds' ";
        $sql .= "FROM customers c ";
        $sql .= "LEFT JOIN purchases p ON p.`customer_id` = c.id  ";
        $sql .= "WHERE c.id = " . $_SESSION['Auth']->id;
        $result = $this->result($sql);
        
        $row = mysqli_fetch_object($result);
        if (!isset($row->funds))
        {
            $_SESSION['Auth'] = $this->add();
            $this->setFunds();
        }
        else
        {
            $_SESSION['Auth']->funds = $row->funds;
        }
    }
    /**
     * Function that generates random person name.
     *
     * @return String random persons name
     */
    public function setName()
    {
        $strnames 
            = "Kathleen Weekly,
            Lucila Hinojosa,
            Cordelia Stanbery,
            Delphine Horan,
            Lorinda Renner,
            Danuta Elsner,
            Nikita Disla,
            Shelley Farrar,
            Bessie Tschanz,
            Ilona Winningham,
            Howard Sundstrom,
            Alysha Kappel,
            Lorenzo Dusek,
            Minda Espy,
            Lavette Grosz,
            Brigitte Record,
            Orpha Liefer,
            Andrew Galligan,
            Odis Longtin,
            Taylor Stormer,
            Leonore Ramires,
            Miki Nyberg,
            Niki Venuti,
            Manuel Clingan,
            Alexandria Kinghorn,
            Norberto Bettes,
            Glinda Spoor,
            Tenisha Summerall,
            Jamila Thweatt,
            Alfonzo Gathings,
            Bradley Vogelsang,
            Tammie Mckissack,
            Clare Bodden,
            Louetta Racey,
            Hilda Donadio,
            Kimi Calmes,
            Mechelle Dortch,
            Andrea Allsup,
            Bethann Charette,
            Prince Keegan,
            Yung Weick,
            Leone Anspach,
            Karin Coe,
            Adriana Payeur,
            Janita Criss,
            Kiersten Bertolini,
            Hanna Cram,
            Yolando Hemstreet,
            Shanti Frisina,
            Oscar Blay,
            Genia Burgett,
            Mathilda Nilges,
            Edra Amsden,
            Yolando Chapple,
            Leisha Hilliker,
            Nobuko Meis,
            France Mcdevitt,
            Elayne Johansson,
            Danielle Mcquaig,
            Yu Lank,
            Georgette Ellard,
            Nenita Runyan,
            Laureen Lejeune,
            Gregorio Hammes,
            Ayana Ingles,
            Arnoldo Burgess,
            Julius Galley,
            Wallace Ellenwood,
            Elwanda Conlin,
            Isobel Wachter,
            Rayford Lindo,
            Nidia Macleod,
            Louanne Profitt,
            Roxann Vanatta,
            Tennille Strahan,
            Everett Ives,
            Altha Hyndman,
            Emmie Sabbagh,
            Lavonia Cogar,
            Dessie Rolls,
            Dusty Mojarro,
            Cammy Enriguez,
            Odis Merlos,
            Rick Strait,
            Minerva Huson,
            Stevie Strub,
            Mistie Vanzile,
            Lady Gudino,
            Barbra Pechacek,
            Deirdre Swords,
            Jerica Spires,
            Leeann Ramos,
            Kellee Mier,
            Zachery Arbuckle,
            Danyell Jakes,
            Reginald Welden,
            Judson Hartung,
            Ora Plain,
            Shayla Mcadory,
            Jamika Ress";

        $names = explode(",", $strnames);

        return trim($names[rand(0, count($names)-1)]);
    }
    
}
?>
