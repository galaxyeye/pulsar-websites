<?php 
	// Enum simulation, by redrik. See http://php.net/manual/en/language.oop5.php

	class Enum {
	    protected $self = array();
	    public function __construct( /*...*/ ) {
	        $args = func_get_args();
	        for( $i=0, $n=count($args); $i<$n; $i++ )
	            $this->add($args[$i]);
	    }
	    
	    public function __get( /*string*/ $name = null ) {
	        return $this->self[$name];
	    }
	    
	    public function add( /*string*/ $name = null, /*int*/ $enum = null ) {
	        if( isset($enum) )
	            $this->self[$name] = $enum;
	        else
	            $this->self[$name] = end($this->self) + 1;
	    }
	}
	
	class DefinedEnum extends Enum {
	    public function __construct( /*array*/ $itms ) {
	        foreach( $itms as $name => $enum )
	            $this->add($name, $enum);
	    }
	}
	
	class FlagsEnum extends Enum {
	    public function __construct( /*...*/ ) {
	        $args = func_get_args();
	        for( $i=0, $n=count($args), $f=0x1; $i<$n; $i++, $f *= 0x2 )
	            $this->add($args[$i], $f);
	    }
	}
?>
