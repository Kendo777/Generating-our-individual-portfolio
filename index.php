<?php
	include("classes.php");
	class WebBuilder
	{
		private $currentPath = __DIR__.DIRECTORY_SEPARATOR."PhPExercise";
		private $arrayGet;
		private $navbarArea;
		private $treeArea;
		private $contentArea;
		private $upload;
		private $result;

		public function constructWebPage()
		{
			//Get all the variables of GET only one time, and send to each class
			foreach ($_GET as $key => $value) {
				$this->arrayGet[$key] = $value;
			}
			//Start the html code
			$this->result = '<!DOCTYPE html>
						<html>
							<head>
								<link rel="stylesheet" type="text/css" href="style/style.css">';

			// Add links, styles and everything that must be in the <head>
			if(isset($this->arrayGet['unit']))
			{
				$this->treeArea = new Tree($this->currentPath, $this->arrayGet);
				$this->result.=$this->treeArea->getTreeStyle();
			}
			if(isset($this->arrayGet['show']) && $this->arrayGet["show"]=="source")
			{
				$this->contentArea = new Content($this->currentPath, $this->arrayGet);
				$this->result.=$this->contentArea->getStylesheet();
			}

			// BODY
			$this->result.='</head>
							<body>
							<h1>IAI-Marc Lozano: ';

			//title and debuger, it shows where you are
			if(isset($this->arrayGet["unit"]))
			{
				$this->result.=" Unit: ".$this->arrayGet["unit"];
			}
			if(isset($this->arrayGet["lesson"]))
			{
				$this->result.=" - Lesson: ".$this->arrayGet["lesson"];
			}
			if(isset($this->arrayGet["exercise"]))
			{
				$this->result.=" - Exercise: ".$this->arrayGet["exercise"];
			}

			$this->result.="</h1>";

			//NAVIGATION BAR
			$this->navbarArea = new NavigationBar($this->currentPath);
			$this->result.=$this->navbarArea->navbarHtmlCode();

			//If we select something form the navbar it will appear the central part (tree, content and upload)
			if(isset($this->arrayGet['unit']))
			{
				$this->result.='<div class="center">';
				$this->result.=$this->treeArea->getTreeHtmlCode();

				// the content area appears but only the buttons if thers no exercise, this is for the Download ALL functionality
				$this->contentArea = new Content($this->currentPath, $this->arrayGet);
				$this->result.=$this->contentArea->getContentHtmlCode();
	
				// Add the upload area because I decided that the user can only upload files inside the lessons
				if(isset($this->arrayGet['lesson']))
				{
					$this->upload = new Upload($this->currentPath,$this->arrayGet);
					$this->result.=$this->upload->getUploadHTMLCode();
				}
				$this->result.='</div>';

			}
				
			
			$this->result.="</body>
			</html>";
			
			//print the whole webpage
			echo $this->result;
		}
	}
	/**
	 * 
	 */

	//Create the web and print it
	$web = new WebBuilder();
	$web->constructWebPage();

	?>
