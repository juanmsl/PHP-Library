<?php

class MySQL {
	private $connected;
	private $hostname;
	private $username;
	private $password;
	private $database;
	private $core;
	public $link;
	public $numQueries = 0;
	
	public function __construct($core, $host, $user, $pass, $db) {
		$this->connected = false;
		$this->core = $core;
		$this->hostname = $host;
		$this->username = $user;
		$this->password = $pass;
		$this->database = $db;
	}
	
	public function isConnected() {
		return $this->connected;
	}
	
	public function connect() {
		$this->link = new mysqli($this->hostname, $this->username, $this->password, $this->database);
		if ($this->link->connect_errno) {
			$this->error($this->link->connect_error);
		} else {
			$this->connected = true;
			if (!$this->link->set_charset("utf8")) {
				$this->error("Couldn't set charset to UTF-8");
			}
		}
	}
	
	public function disconnect() {
		if($this->connected) {
			$this->link->Close() or $this->error("could not close conn");
			$this->connected = false;
		}
	}
	
	public function doQuery($query) {
		if($this->IsConnected()) {
			$this->numQueries++;
			$resultset = $this->link->query($query) or $this->error($this->link->error);
			return $resultset;
		} else {
			$this->error('Could not process query, no active db connection detected..');
		}
	}
	
	public function evaluate($query, $i = 0) {
		if($this->IsConnected()) {
			$result = $this->doQuery($query);
			$row = $result->fetch_row();
			return $row[$i];
		} else {
			$this->error('Could not process query, no active db connection detected..');
		}
	}
	
	public function error($errorString) {
		$core->systemError('Database fail', $errorString);
	}
	
	public function __destruct() {
		$this->disconnect();
	}
}

?>