<?php
	$template=<<<EOF
<?php
	class $name extends Woldy{
		public function run(\$mothod,\$type){
			if(empty(\$type)){
				\$result=\$this->\$mothod();
			}
			else{
				\$fn=\$mothod.'_'.\$type;
				\$result=\$this->\$fn();
			}
			\$this->json(\$result);
		}
		public function get(){
			\$result=true;
			return \$result;
		}
		
		public function set(){
			\$result=true;
			return \$result;
		}
		
		public function op(){
			\$result=true;
			return \$result;
		}
	}
EOF;
	return $template;