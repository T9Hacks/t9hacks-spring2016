<?php
include_once '../EmailHelperClass.php';

$styles = EmailHelperClass::getEmailStyles();
$linkStyles = $styles['linkStyles'];

echo EmailHelperClass::createEmailHeader();
?>

<tr><td style='padding: 20px 20px 0 20px;'>
	<h2 style='padding: 0; margin: 15px 0;'>T9Hacks is 2 weeks away!</h2>
</td></tr>

<tr><td style='padding: 0 20px;'>
	<hr/>
</td></tr>

<tr><td style='padding: 20px 20px 0 20px;'>
	<p>
		We are extremely excited that you are coming to T9Hacks!  With an the hackathon 
		date approaching so quickly, we wanted to send out a few updates.
	</p>
	<ul>
		<li style='padding: 0 0 20px;'>
			<b>UPDATE YOUR REGISTRATION!</b>  We have awesome local sponsors and they are excited to meet you.  
			They best way for them to get to know you is for you to give them access to your resume, Linkedin, 
			and Github. It's a great opportunity to network and gain exposure.
		</li>
		<li style='padding: 0 0 20px;'>
			<b>Join the T9Hacks Team Formation Facebook Group!</b> This group is for T9Hacks participants to find team 
			members! Post your ideas and let us help you meet like-minded people to work with. 
			<a href="https://www.facebook.com/groups/1551033121876747/" style='<?php echo $linkStyles; ?>' target='_blank' wotsearchprocessed='true'>T9Hacks Team Formation</a>
		</li>
		<li style='padding: 0 0 20px;'>
			<b>Answer your questions!</b> Have questions about the event?  Read over the answers to 
			<a href="http://www.t9hacks.org/#about" style='<?php echo $linkStyles; ?>' target='_blank' wotsearchprocessed='true'>Commonly asked quesions here</a>.  
			We also are a proud Major League Hackathon (MLH) event, which means we follow the 
			<a href="http://static.mlh.io/docs/mlh-code-of-conduct.pdf">MLH Code of Conduct</a>.
			We are also a CU Affiliated Club event, which means we have to follow the university's rules.  This 
			means no alcohol, drugs, weapons, or cute live animals.
			If your question hasn't been answered yet, feel free to contact us over social media or email and we'll 
			get you all the information you need!
		</li>
		<li style='padding: 0 0 20px;'>
			<b>Bring your friends!</b> Registration is filling up quickly! If you have friends who want to come, 
			they must register by Friday, Feb 12.  We have to plan for space and food, so we cannot take registrations 
			a the event.
		</li>
	</ul>


	
	
	
	
	
	

</td></tr>

<?php 

echo EmailHelperClass::createEmailFooter("[[NAME]]");
