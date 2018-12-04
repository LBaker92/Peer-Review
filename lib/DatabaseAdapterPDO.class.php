<?php

/*

Acts as an adapter for our database API so that all database api specific code
will reside here in this class. In this example, we will use the PDO API.

Code inspired from:
https://github.com/codeinthehole/domain-model-mapper
http://www.devshed.com/c/a/PHP/PHP-Service-Layers-Database-Adapters/

 */

class DatabaseAdapterPDO implements DatabaseAdapterInterface
{
    private $pdo;
    private $lastStatement = null;

    /*

    Constructor is passed an array containing the following connection information:
        $values[0] -- connection string
        $values[1] -- user name
        $values[2] -- password

     */

    public function __construct($values)
    {
        $this->setConnectionInfo($values);
    }

    /*

    Sets the connection information and returns a valid PDO object
    See constructor for details about passed parameter

    */

    public function setConnectionInfo($values = array())
    {
        $connString = $values[0];
        $user = $values[1];
        $password = $values[2];
        $pdo = new PDO($connString, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo;
    }

    // Closes the connection
    public function closeConnection()
    {
        $pdo = null;
    }

    /*

    Executes an SQL query and returns the PDO statement object

    Note that execute() takes an array as a parameter
    If using named parameters:
        Pass an assoc array where indices are the named parameters

    If not using named parameters:
        Pass an array of values

    NAMED PLACEHOLDER EX: 
        $parameters = [
            ':name' = "John"
            ':id' = 1,
        ]

        "SELECT id FROM table WHERE id = :id, name = :name"
        "SELECT id FROM table WHERE id = 1, name = John"

    NON NAMED PLACEHOLDER EX: 
        $parameters = [
            "John",
            1
        ]

        "SELECT id FROM table WHERE id = ?, name = ?"
        "SELECT id FROM table WHERE id = John, name = 1"

        Because the placeholders were not named,
        they are bound in the order they appear in the array.

    */

    public function runQuery($sql, $parameters = array())
    {
        // Ensure parameters are in an array
        if (!is_array($parameters)) {
            $parameters = array($parameters);
        }

        $this->lastStatement = null;
        if (count($parameters) > 0) {
            // Use a prepared statement if parameters
            // Also bind the parameters to the sql statement.
            $this->lastStatement = $this->pdo->prepare($sql);
            $executedOk = $this->lastStatement->execute($parameters);
            if (!$executedOk) {
                throw new PDOException;
            }
        } else {
            // Execute a normal query
            $this->lastStatement = $this->pdo->query($sql);
            if (!$this->lastStatement) {
                throw new PDOException;
            }
        }
        return $this->lastStatement;
    }

    // Wraps single quotes around a table or fieldname identifier
    private function quoteIdentifier($identifier)
    {
        return sprintf("'%s'", $identifier);
    }

    // Wraps single quotes around a table or fieldname identifier
    private function backtickIdentifier($identifier)
    {
        return sprintf("`%s`", $identifier);
    }

    // Returns a single field value as a string
    public function fetchField($sql, $parameters = array())
    {
        $row = $this->fetchRow($sql, $parameters);

        // If a row is returned and isn't empty
        // remove the first element of the array and return it otherwise return null
        return ($row && count($row) > 0) ? array_shift($row) : null;
    }

    // Returns a row of database data
    public function fetchRow($sql, $parameters = array())
    {
        $statement = $this->runQuery($sql, $parameters);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // If a row is turned, return the row array, otherwise return null
        return $row ? $row : null;
    }

    // Returns an array of rows
    public function fetchAsArray($sql, $parameters = array())
    {
        $statement = $this->runQuery($sql, $parameters);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserts data into a table
    public function insert($tableName, $parameters = array())
    {
        $fields = array();
        $values = array();

        // Extract fields and values from parameters
        foreach ($parameters as $field => $value) {
            // Adds the converted field name to the fields array and adds placeholders for all values.
            // EX: user_id becomes `user_id`
            $fields[] = $this->backtickIdentifier($field);
            $values[] = '?';
        }
        // Construct SQL and execute
        $escapedTableName = $this->backtickIdentifier($tableName);

        /*

        Replaces %s with the values pased into the sprintf function.
        implode returns a string with the array values seperated by ', '
        EX: 
            "INSERT INTO %s (%s) VALUES (%s)
            "INSERT INTO `tablename` (`user_id`, `user_name`) VALUES (?, ?)

         */

        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $escapedTableName, implode(', ', $fields), implode(', ', $values));
        
        /*

        Sends the values of the parameter array to the query runner, which binds the values to each '?' placeholder.
        EX: "INSERT INTO `tablename` (`user_id`, `user_name`) VALUES (?, ?)
        "INSERT INTO `tablename` (`user_id`, `user_name`) VALUES (value0, value1)

         */

        return $this->runQuery($sql, array_values($parameters));
    }

    // Returns the last insert id
    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    /*

    Executes an UPDATE statement and returns the number of rows affected

    Takes an array of parameters
    Generates a placeholder from the index
    Adds an assignment string to an array
    Adds the value of the array to a new array where the index is the placeholder

    EX: $updateParameters = [
    'ID' => 1,
    'Name' => "John",
    ]

    $assignments = [
    'ID = :id',
    'Name = :name'
    ]

    $parameters = [
    'id' => 1,
    'name' => "John"
    ]

    Then modifies the sql statement to include the assignments

    EX: "UPDATE %s SET %s"
    "UPDATE `tableName` SET ID = :id, Name = :name
    
    */

    public function update($tableName, $updateParameters = array(), $whereCondition = '', $whereParameters = array())
    {
        // Determine field assignments
        $assignments = array();
        $parameters = array();

        foreach ($updateParameters as $field => $value) {
            $placeHolder = strtolower($field);
            $assignments[] = sprintf("%s = %s", $field, ":$placeHolder");
            $parameters[$placeHolder] = $value;
        }

        // Construct SQL
        $escapedTableName = $this->backtickIdentifier($tableName);
        $sql = sprintf("UPDATE %s SET %s", $escapedTableName, implode(', ', $assignments));

        // If there is a where condition, append it to the SQL
        // Also append the where parameters to the parameters array.
        if ($whereCondition) {
            $sql .= " WHERE $whereCondition ";
            $parameters = array_merge($parameters, $whereParameters);
        }

        $statement = $this->runQuery($sql, $parameters);

        // Return the number of rows affected
        return $statement->rowCount();
    }

    // Executes a DELETE statement and returns the number of rows deleted
    public function delete($tableName, $whereCondition = null, $whereParameters = array())
    {
        $sql = sprintf("DELETE FROM %s ", $this->backtickIdentifier($tableName));
        $parameters = array();

        // If there is a where condition, append it to the SQL
        // Also assign the where parameters to the parameters array.
        if ($whereCondition) {
            $sql .= "WHERE $whereCondition";
            $parameters = $whereParameters;
        }
        $statement = $this->runQuery($sql, $parameters);

        // Return the number of rows affected
        return $statement->rowCount();
    }

    // Begins a transaction
    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
        return $this;
    }

    // Commits current transaction
    public function commit()
    {
        $this->pdo->commit();
        return $this;
    }

    // Rolls back current transaction
    public function rollBack()
    {
        $this->pdo->rollBack();
        return $this;
    }

    // Returns the number of rows affected by the last SQL statement
    public function getNumRowsAffected()
    {
        if (!$this->lastStatement) {
            return null;
        }
        return $this->lastStatement->rowCount();
    }
}

?>