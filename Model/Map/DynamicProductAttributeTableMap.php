<?php

namespace DynamicProductAttributes\Model\Map;

use DynamicProductAttributes\Model\DynamicProductAttribute;
use DynamicProductAttributes\Model\DynamicProductAttributeQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'dynamic_product_attribute' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class DynamicProductAttributeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;
    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'DynamicProductAttributes.Model.Map.DynamicProductAttributeTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'thelia';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'dynamic_product_attribute';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\DynamicProductAttributes\\Model\\DynamicProductAttribute';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'DynamicProductAttributes.Model.DynamicProductAttribute';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the ID field
     */
    const ID = 'dynamic_product_attribute.ID';

    /**
     * the column name for the CART_ITEM_ID field
     */
    const CART_ITEM_ID = 'dynamic_product_attribute.CART_ITEM_ID';

    /**
     * the column name for the ATTRIBUTE_ID field
     */
    const ATTRIBUTE_ID = 'dynamic_product_attribute.ATTRIBUTE_ID';

    /**
     * the column name for the ATTRIBUTE_VALUE field
     */
    const ATTRIBUTE_VALUE = 'dynamic_product_attribute.ATTRIBUTE_VALUE';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'CartItemId', 'AttributeId', 'AttributeValue', ),
        self::TYPE_STUDLYPHPNAME => array('id', 'cartItemId', 'attributeId', 'attributeValue', ),
        self::TYPE_COLNAME       => array(DynamicProductAttributeTableMap::ID, DynamicProductAttributeTableMap::CART_ITEM_ID, DynamicProductAttributeTableMap::ATTRIBUTE_ID, DynamicProductAttributeTableMap::ATTRIBUTE_VALUE, ),
        self::TYPE_RAW_COLNAME   => array('ID', 'CART_ITEM_ID', 'ATTRIBUTE_ID', 'ATTRIBUTE_VALUE', ),
        self::TYPE_FIELDNAME     => array('id', 'cart_item_id', 'attribute_id', 'attribute_value', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'CartItemId' => 1, 'AttributeId' => 2, 'AttributeValue' => 3, ),
        self::TYPE_STUDLYPHPNAME => array('id' => 0, 'cartItemId' => 1, 'attributeId' => 2, 'attributeValue' => 3, ),
        self::TYPE_COLNAME       => array(DynamicProductAttributeTableMap::ID => 0, DynamicProductAttributeTableMap::CART_ITEM_ID => 1, DynamicProductAttributeTableMap::ATTRIBUTE_ID => 2, DynamicProductAttributeTableMap::ATTRIBUTE_VALUE => 3, ),
        self::TYPE_RAW_COLNAME   => array('ID' => 0, 'CART_ITEM_ID' => 1, 'ATTRIBUTE_ID' => 2, 'ATTRIBUTE_VALUE' => 3, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'cart_item_id' => 1, 'attribute_id' => 2, 'attribute_value' => 3, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('dynamic_product_attribute');
        $this->setPhpName('DynamicProductAttribute');
        $this->setClassName('\\DynamicProductAttributes\\Model\\DynamicProductAttribute');
        $this->setPackage('DynamicProductAttributes.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('CART_ITEM_ID', 'CartItemId', 'INTEGER', 'cart_item', 'ID', true, null, null);
        $this->addForeignKey('ATTRIBUTE_ID', 'AttributeId', 'INTEGER', 'attribute', 'ID', true, null, null);
        $this->addColumn('ATTRIBUTE_VALUE', 'AttributeValue', 'CLOB', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('CartItem', '\\Thelia\\Model\\CartItem', RelationMap::MANY_TO_ONE, array('cart_item_id' => 'id', ), 'CASCADE', 'RESTRICT');
        $this->addRelation('Attribute', '\\Thelia\\Model\\Attribute', RelationMap::MANY_TO_ONE, array('attribute_id' => 'id', ), 'CASCADE', 'RESTRICT');
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {

            return (int) $row[
                            $indexType == TableMap::TYPE_NUM
                            ? 0 + $offset
                            : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
                        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? DynamicProductAttributeTableMap::CLASS_DEFAULT : DynamicProductAttributeTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     * @return array (DynamicProductAttribute object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = DynamicProductAttributeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DynamicProductAttributeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DynamicProductAttributeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DynamicProductAttributeTableMap::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DynamicProductAttributeTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = DynamicProductAttributeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DynamicProductAttributeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DynamicProductAttributeTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(DynamicProductAttributeTableMap::ID);
            $criteria->addSelectColumn(DynamicProductAttributeTableMap::CART_ITEM_ID);
            $criteria->addSelectColumn(DynamicProductAttributeTableMap::ATTRIBUTE_ID);
            $criteria->addSelectColumn(DynamicProductAttributeTableMap::ATTRIBUTE_VALUE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.CART_ITEM_ID');
            $criteria->addSelectColumn($alias . '.ATTRIBUTE_ID');
            $criteria->addSelectColumn($alias . '.ATTRIBUTE_VALUE');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(DynamicProductAttributeTableMap::DATABASE_NAME)->getTable(DynamicProductAttributeTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getServiceContainer()->getDatabaseMap(DynamicProductAttributeTableMap::DATABASE_NAME);
      if (!$dbMap->hasTable(DynamicProductAttributeTableMap::TABLE_NAME)) {
        $dbMap->addTableObject(new DynamicProductAttributeTableMap());
      }
    }

    /**
     * Performs a DELETE on the database, given a DynamicProductAttribute or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or DynamicProductAttribute object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DynamicProductAttributeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DynamicProductAttributes\Model\DynamicProductAttribute) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DynamicProductAttributeTableMap::DATABASE_NAME);
            $criteria->add(DynamicProductAttributeTableMap::ID, (array) $values, Criteria::IN);
        }

        $query = DynamicProductAttributeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) { DynamicProductAttributeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) { DynamicProductAttributeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the dynamic_product_attribute table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return DynamicProductAttributeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a DynamicProductAttribute or Criteria object.
     *
     * @param mixed               $criteria Criteria or DynamicProductAttribute object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DynamicProductAttributeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from DynamicProductAttribute object
        }

        if ($criteria->containsKey(DynamicProductAttributeTableMap::ID) && $criteria->keyContainsValue(DynamicProductAttributeTableMap::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DynamicProductAttributeTableMap::ID.')');
        }


        // Set the correct dbName
        $query = DynamicProductAttributeQuery::create()->mergeWith($criteria);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = $query->doInsert($con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

} // DynamicProductAttributeTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
DynamicProductAttributeTableMap::buildTableMap();
