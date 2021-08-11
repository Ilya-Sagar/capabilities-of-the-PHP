<?php

class Model extends Facade
{
    /**
     * Contains params for conditions of sql query
     *
     * @var array
     */
    protected static $queryParams = [];


    /**
     * Add param(s) into self::$queryParams
     *
     * @param $params
     * @return $this
     */
    protected function add($params)
    {
        foreach ($params as $key => $value) {
            $column = $this->parseColumn($key);
            $operator = $this->parseOperator($key);

            if (is_array($value)) {
                self::$queryParams[$column] = [
                    'value' => $value['value'],
                    'operator' => $value['operator'] ?? $operator
                ];
            }

            if (is_string($value) || is_int($value)) {
                self::$queryParams[$column] = [
                    'value' => $value,
                    'operator' => $operator
                ];
            }
        }

        return $this;
    }

    /**
     * Remove param(s) form self::$queryParams
     *
     * @param $params
     * @return $this
     */
    protected function destroy($params)
    {
        if (is_string($params)) {
            unset(self::$queryParams[$params]);
        }

        if (is_array($params))
        {
            foreach ($params as $param) {
                unset(self::$queryParams[$param]);
            }
        }

        return $this;
    }

    /**
     * Make query with conditions
     *
     * @return string
     */
    protected function getSql()
    {
        $table = strtolower(get_class($this)) . 's';
        $query = 'select * form ' . $table;

        if (self::$queryParams != null) {
            $query .= ' where';

            foreach (self::$queryParams as $column => $params) {
                $query .= ' and ' . $column . ' ' . $params['operator'] . ' ' . $params['value'];
            }

            $query = preg_replace('#where and#', 'where', $query);
        }
        return $query;
    }

    private function parseOperator($str)
    {
        $result = preg_match('#^.*[^a-zA-Z]+#', $str, $founds);
        if ($result) {
            return $founds[0];
        } else {
            return '=';
        }
    }

    private function parseColumn($str)
    {
        $result = preg_match('#[a-zA-Z]+$#', $str, $founds);
        if ($result) {
            return $founds[0];
        } else {
            return '=';
        }

    }
}