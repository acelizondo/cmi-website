	<?php
		class CMITemplate
		{
			protected $output = "";
			protected $title = "";
			protected $userName = "";
			protected $stylesheets = array();
			protected $scripts = array();
			protected $page;
			protected $errors = array();

			/**
			 *Class Constructor
			 *
			 *The constructor will load in all style sheets and scripts needed at a global level. Class should be
			 *should be extended within each local page to load in page specific scripts and stylesheets.
             *
             * @param page
             * @param $title
             *
			*/
		
			public function __construct($page, $title){
				global $config, $logged_user;
				$this->page = $page;
                $this->title = $title;
				//jquery
				$this->addScript('Resources/library/jquery/js/jquery-1.12.0.js', $config['base_url']);
				//bootstrap
				$this->addScript('Resources/library/bootstrap/js/bootstrap.min.js', $config['base_url']);
				$this->addStyleSheet('Resources/library/bootstrap/css/bootstrap.min.css', $config['base_url']);
                $this->addScript('Resources/library/bootstrap/css/bootstrap.css', $config['base_url']);
                //fontawesome
                $this->addStylesheet('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800', "0");
                $this->addStylesheet('http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic', "0");
                $this->addStylesheet('Resources/font-awesome/css/font-awesome.min.css', $config['base_url']);
				$this->addStyleSheet('Resources/css/creative1.css', $config['base_url']);
				//if($logged_user)
				//	$this->username = $logged_user->fullName();
			}

			public function setPage($p)
			{
				$this->page = $p;
			}

			//public function setLoggedUser($user)
			//{
			//	$this->username = $user;
			//}{$this->title}

			public function setTitle($title)
			{
				$this->title = $title;
			}

			public function addStylesheet($filename, $path = NULL)
			{
				global $config;
				if ($path == NULL) {
					$path = $config['abs_url'] . '/';
				 }
	
				 $file = $path . $filename;

				 if (!in_array($file, $this->stylesheets)) {
					    $this->stylesheets[] = $file;
				}
			}

			public function addScript($filename, $path = NULL)
			{
				global $config;
				if ($path == NULL) {
					$path =  $config['abs_url'] . '/';
				}
				$file = $path . $filename;
				if (!in_array($file, $this->scripts)) {
					$this->scripts[] = $file;
				}
			}

			private function printStylesheets()
			{
				if (!empty($this->stylesheets)) {

					$output = "";
	
					foreach ($this->stylesheets AS $stylesheet) {
						$output .= "<link rel='stylesheet' type='text/css' href='{$stylesheet}'>";
					}

					return $output;
				} else {
					return "";
				}
			}

			private function printScripts()
			{
				if (!empty($this->scripts)) {

					$output = "";

					foreach ($this->scripts AS $script) {
						$output .= "<script type='text/javascript' src='{$script}'></script>";
					}

					return $output;
				} else {
					return "";
				}
			}

		//Prints off default head and body. Will likely be changed by local pages
		public function printHead()
		{
			$output = "";
			$output .= $this->generateHTMLHead();
			$output .= $this->generateHTMLBody();
			return $output;
		}

		//Generates needed HTML head code
		protected function generateHTMLHead($html = "")
		{
			global $config, $logged_user;

			// Begin building the header

			$out = "<!DOCTYPE html>
			<html><head>
			<meta charset='UTF-8'>
			<meta http-equiv='X-UA-Compatible' content='IE=chrome'>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			<meta name='viewport' content='width=device-width, initial-scale=1'>
			<meta name='author' content='Aaron Elizondo'>";
            $out .= "<title>{$this->title}</title>";
			$out .= $this->printStylesheets();
			//$out .= "<script>var baseURL='{$config['abs_url']}';</script>";

			$out .= $html;
			$out .= "</head>";

			return $out;
		}

		protected function generateHTMLBody($html_head="")
		{
			global $config, $logged_user;
			
			$out = "<body id ='page-top'>";
			$out .= $this->generateNavBar();
			return $out;
		}

		//Generates Navbar to be used for every page
		private function generateNavBar()
		{
			global $logged_user, $config;
			$url = $config['home_url'] . '/homepage.php';
			$nav = "<nav id='mainNav' class='navbar navbar-default navbar-fixed-top'>
				<div class='container-fluid'>
				<div class='navbar-header'>";
			//Handles altered menus for smaller windows
			$nav .= "<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1'>
				<span class='sr-only'>Toggle navigation</span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span></button>";
			$nav .= "<a id='cmiMadison' class='navbar-brand page-scroll' href='{$url}'>CMI-Madison</a></div>";
			//Handles the list of links(Needs to be changed to links of other pages
			$nav .= "<div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
				<ul class='nav navbar-nav navbar-right'>
					<li><a class='page-scroll' href='{$url}#about'>About</a></li>
					<li><a class='page-scroll' href='{$url}#services'>Goals</a></li>
					<li><a class='page-scroll' href='{$url}#portfolio'>Events</a></li>
					<li><a class='page-scroll' href='{$url}#contact'>Contact</a></li>";
			//if($logged_user->admin)
			//{
			//	$nav .= "<li><a class='page-scroll' href='page-top'>Admin</a></li>";
			//}
			$nav .= "</ul></div></nav>";
			return $nav;
		}

		public function printFooter($html="")
		{
			return $this->generateHTMLFooter($html);
		}

		protected function generateHTMLFooter($html)
		{
			$footer = "";
			$footer .= $this->generateContact();
            $footer .= $this->printScripts();
			$footer .= $html;
			$footer .= "</body></html>";
			return $footer;
		}

		private function generateContact(){
			//global $config;

			$contact = "<section id='contact' class='bg-primary'>
				<div class='container'>
					<div class='row'>
						<div class='col-lg-8 col-lg-offset-2 text-center' id='contact-top'>
							<h2 class='section-heading'>Let's Get In Touch!</h2>
							<hr class='primary'>
							<p>Have any questions? Send us an email!</p>
						</div>
						<form class='form-basic' method='post' action='#contact'>

            				<div class'form-row'>
                				<label>
                    				<span style='text-align:center;'>Full name</span>
                    				<input type='text' name='name' class='center-block'>
                				</label>
            				</div>

            				<div class='form-row'>
                				<label>
                    				<span style='text-align:center;'>Email</span>
                    				<input type='email' name='email' class='center-block'>
                				</label>
            				</div>

            				<div class='form-row'>
                				<label>
                    				<span style='text-align:center;'>Text</span>
									<textarea name='textarea' class='center-block'></textarea>
                				</label>
            				</div>

            				<div class='form-row'>
                				<button type='submit'>Send Email</button>
            				</div>

        				</form>
						<div class='col-lg text-center'>
							<a href='https://twitter.com/CMIBadgers' target='_blank'>
								<i class='fa fa-twitter fa-3x wow bounceIn' name='twitter'></i>
							</a>
						</div>
						<div class='col-lg text-center'>
							<a href='https://www.facebook.com/CMIBadgers'target='_blank'>
								<i class='fa fa-facebook fa-3x wow bounceIn' name='facebook'></i>
							</a>
						</div>
					</div>
				</div>
			</section>";
            return $contact;
		}


		//Handles Errors
		public function error($message, $type)
		{
			$this->errors[$type][] = $message;
		}


	

	}
		 
	?>