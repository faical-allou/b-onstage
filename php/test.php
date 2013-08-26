<?php
/*
php5 class (will not work in php4)
for detecting bitrate and duration of regular mp3 files (not VBR files)
*/

//-----------------------------------------------------------------------------
class mp3 {

	private $fp, $filesize, $fileanalysis;
	private $id3v1, $id3v2, $data;

	private $audio_frames, $audio_frames_total;
	private $pos_audio_start, $pos_audio_end;

	private $bitrate_max, $bitrate_min, $bitrate_sum;

	var $id3v1_genres = array
		(
		'Blues', 'Classic Rock', 'Country', 'Dance', 'Disco', 'Funk', 'Grunge', 'Hip-Hop', 'Jazz', 'Metal', 
		'New Age', 'Oldies', 'Other', 'Pop', 'R&B', 'Rap', 'Reggae', 'Rock', 'Techno', 'Industrial', 
		'Alternative', 'Ska', 'Death Metal', 'Pranks', 'Soundtrack', 'Euro-Techno', 'Ambient', 'Trip-Hop', 'Vocal', 'Jazz+Funk', 
		'Fusion', 'Trance', 'Classical', 'Instrumental', 'Acid', 'House', 'Game', 'Sound Clip', 'Gospel', 'Noise', 
		'AlternRock', 'Bass', 'Soul', 'Punk', 'Space', 'Meditative', 'Instrumental Pop', 'Instrumental Rock', 'Ethnic', 'Gothic', 
		'Darkwave', 'Techno-Industrial', 'Electronic', 'Pop-Folk', 'Eurodance', 'Dream', 'Southern Rock', 'Comedy', 'Cult', 'Gangsta', 
		'Top 40', 'Christian Rap', 'Pop/Funk', 'Jungle', 'Native American', 'Cabaret', 'New Wave', 'Psychadelic', 'Rave', 'Showtunes', 
		'Trailer', 'Lo-Fi', 'Tribal', 'Acid Punk', 'Acid Jazz', 'Polka', 'Retro', 'Musical', 'Rock & Roll', 'Hard Rock', 
		'Folk', 'Folk/Rock', 'National Folk', 'Swing', 'Fast-Fusion', 'Bebob', 'Latin', 'Revival', 'Celtic', 'Bluegrass', 
		'Advantgarde', 'Gothic Rock', 'Progressive Rock', 'Psychadelic Rock', 'Symphonic Rock', 'Slow Rock', 'Big Band', 'Chorus', 'Easy Listening', 'Acoustic', 
		'Humour', 'Speech', 'Chanson', 'Opera', 'Chamber Music', 'Sonata', 'Symphony', 'Booty Bass', 'Primus', 'Porn Groove', 
		'Satire', 'Slow Jam', 'Club', 'Tango', 'Samba', 'Folklore'
		);

	var $id3v2_frame_descriptions = array
		(
		'AENC' => 'Audio encryption',
		'APIC' => 'Attached picture',
		'COMM' => 'Comments',
		'COMR' => 'Commercial frame',
		'ENCR' => 'Encryption method registration',
		'EQUA' => 'Equalization',
		'ETCO' => 'Event timing codes',
		'GEOB' => 'General encapsulated object',
		'GRID' => 'Group identification registration',
		'IPLS' => 'Involved people list',
		'LINK' => 'Linked information',
		'MCDI' => 'Music CD identifier',
		'MLLT' => 'MPEG location lookup table',
		'OWNE' => 'Ownership frame',
		'PRIV' => 'Private frame',
		'PCNT' => 'Play counter',
		'POPM' => 'Popularimeter',
		'POSS' => 'Position synchronisation frame',
		'RBUF' => 'Recommended buffer size',
		'RVAD' => 'Relative volume adjustment',
		'RVRB' => 'Reverb',
		'SYLT' => 'Synchronized lyric/text',
		'SYTC' => 'Synchronized tempo codes',
		'TALB' => 'Album/Movie/Show title',
		'TBPM' => 'BPM (beats per minute)',
		'TCOM' => 'Composer',
		'TCON' => 'Content type',
		'TCOP' => 'Copyright message',
		'TDAT' => 'Date',
		'TDLY' => 'Playlist delay',
		'TENC' => 'Encoded by',
		'TEXT' => 'Lyricist/Text writer',
		'TFLT' => 'File type',
		'TIME' => 'Time',
		'TIT1' => 'Content group description',
		'TIT2' => 'Title/songname/content description',
		'TIT3' => 'Subtitle/Description refinement',
		'TKEY' => 'Initial key',
		'TLAN' => 'Language(s)',
		'TLEN' => 'Length',
		'TMED' => 'Media type',
		'TOAL' => 'Original album/movie/show title',
		'TOFN' => 'Original filename',
		'TOLY' => 'Original lyricist(s)/text writer(s)',
		'TOPE' => 'Original artist(s)/performer(s)',
		'TORY' => 'Original release year',
		'TOWN' => 'File owner/licensee',
		'TPE1' => 'Lead performer(s)/Soloist(s)',
		'TPE2' => 'Band/orchestra/accompaniment',
		'TPE3' => 'Conductor/performer refinement',
		'TPE4' => 'Interpreted, remixed, or otherwise modified by',
		'TPOS' => 'Part of a set',
		'TPUB' => 'Publisher',
		'TRCK' => 'Track number/Position in set',
		'TRDA' => 'Recording dates',
		'TRSN' => 'Internet radio station name',
		'TRSO' => 'Internet radio station owner',
		'TSIZ' => 'Size',
		'TSRC' => 'ISRC (international standard recording code)',
		'TSSE' => 'Software/Hardware and settings used for encoding',
		'TYER' => 'Year',
		'UFID' => 'Unique file identifier',
		'USER' => 'Terms of use',
		'USLT' => 'Unsychronized lyric/text transcription',
		'WCOM' => 'Commercial information',
		'WCOP' => 'Copyright/Legal information',
		'WOAF' => 'Official audio file webpage',
		'WOAR' => 'Official artist/performer webpage',
		'WOAS' => 'Official audio source webpage',
		'WORS' => 'Official internet radio station homepage',
		'WPAY' => 'Payment',
		'WPUB' => 'Publishers official webpage'
		);

	var $bitrates = array
		(
		'0000' => array(array('~', '~', '~'), array('~', '~', '~')),
		'0001' => array(array('32', '32', '32'), array('32', '8', '8')),
		'0010' => array(array('64', '48', '40'), array('48', '16', '16')),
		'0011' => array(array('96', '56', '48'), array('56', '24', '24')),
		'0100' => array(array('128', '64', '56'), array('64', '32', '32')),
		'0101' => array(array('160', '80', '64'), array('80', '40', '40')),
		'0110' => array(array('192', '96', '80'), array('96', '48', '48')),
		'0111' => array(array('224', '112', '96'), array('112', '56', '56')),
		'1000' => array(array('256', '128', '112'), array('128', '64', '64')),
		'1001' => array(array('288', '160', '128'), array('144', '80', '80')),
		'1010' => array(array('320', '192', '160'), array('160', '96', '96')),
		'1011' => array(array('352', '224', '192'), array('176', '112', '112')),
		'1100' => array(array('384', '256', '224'), array('192', '128', '128')),
		'1101' => array(array('416', '320', '256'), array('224', '144', '144')),
		'1110' => array(array('448', '384', '320'), array('256', '160', '160'))
		);

	var $sampling_frequencys = array
		(
		'00' => array('44100', '22050', '11025'),
		'01' => array('48000', '24000', '12000'),
		'10' => array('32000', '16000', '8000')
		);

	var $modes = array
		(
		'00' => 'Stereo',
		'01' => 'Joint Stereo',
		'10' => 'Dual Channel',
		'11' => 'Single Channel'
		);

	var $mode_extensions = array
		(
		'00' => array(0, 0),
		'01' => array(1, 0),
		'10' => array(0, 1),
		'11' => array(1, 1),
		);

	function get_mp3($filepath, $analysis = false, $getframesindex = false) {

		$getframesindex = $analysis ? $getframesindex : false;
		$this->fileanalysis = intval(!empty($analysis)) + intval(!empty($getframesindex));

		if(!$this->fp = @fopen($filepath, 'rb')) {
			return false;
		}

		$this->filesize = filesize($filepath);
		$this->id3v1 = $this->id3v2 = $this->data = array();

		$this->audio_frames = array();
		$this->audio_frames_total = 0;

		$this->pos_audio_start = $this->pos_audio_end = 0;
		$this->bitrate_max = $this->bitrate_min = $this->bitrate_sum = 0;

		$this->get_id3v2();
		$this->get_id3v1();
		$this->get_data();

		$return = array
			(
			'data' => $this->data,
			'id3v2' => $this->id3v2,
			'id3v1' => $this->id3v1,
			'frames' => $getframesindex ? $this->audio_frames : false
			);

		foreach($return as $variable => $value) {
			if(!$value) {
				unset($return[$variable]);
			}
		}

		return $return;

	}

	private function get_id3v2() {

		$pos_call = ftell($this->fp);
		$tag = array();

		$tagheaderdata = fread($this->fp, 10);
		$tagheader = @unpack('a3identifier/Cversion/Crevision/Cflag/Csize0/Csize1/Csize2/Csize3', $tagheaderdata);

		if(!$tagheader || $tagheader['identifier'] != 'ID3') {
			fseek($this->fp, $pos_call);
			return false;
		}

		$tag['version'] = $tagheader['version'];
		$tag['revision'] = $tagheader['revision'];

		$tagflag = $this->conv_flag($tagheader['flag']);

		$tag['flag'] = array
			(
			'unsynchronisation' => $tagflag{0},
			'extra' => $tagflag{1},
			'istest' => $tagflag{2}
			);

		$tagsize = ($tagheader['size0'] & 0x7F) << 21
			| ($tagheader['size1'] & 0x7F) << 14
			| ($tagheader['size2'] & 0x7F) << 7
			| ($tagheader['size3']);

		if(($tagsize = intval($tagsize)) < 1) {
			return false;
		}

		$tag['size'] = $tagsize;
		$tag['frames'] = array();

		$pos_start = ftell($this->fp);
		$pos_end = $pos_start + $tagsize - 10;

		while(1) {

			if(ftell($this->fp) >= $pos_end) {
				break;
			}

			$frameheaderdata = fread($this->fp, 10);
			$frameheader = @unpack('a4frameid/Nsize/Cflag0/Cflag1', $frameheaderdata);

			if(!$frameheader || !$frameheader['frameid']) {
				continue;
			}

			$frameid = $frameheader['frameid'];
			$framedescription = 'Unknown';

			if(isset($this->id3v2_frame_descriptions[$frameid])) {
				$framedescription = $this->id3v2_frame_descriptions[$frameid];
			} else {
				switch(strtoupper($frameid{0})) {
					case 'T': $framedescription = 'User defined text information frame'; break;
					case 'W': $framedescription = 'User defined URL link frame'; break;
				}
			}

			if(($framesize = $frameheader['size']) < 1 || (ftell($this->fp) + $framesize) > $pos_end) {
				continue;
			}

			$frameflag = array
				(
				$this->conv_flag($frameheader['flag0']),
				$this->conv_flag($frameheader['flag1'])
				);

			$framecharsetdata = @unpack('c', fread($this->fp, 1));
			$framecharset = '';

			switch($framecharsetdata) {
				case 0: $framecharset = 'ISO-8859-1'; break;
				case 1: $framecharset = 'UTF-16'; break;
				case 2: $framecharset = 'UTF-16BE'; break;
				case 3: $framecharset = 'UTF-8'; break;
			}

			if($framecharset) {
				$framedatasize = $framesize - 1;
			} else {
				$framedatasize = $framesize;
				fseek($this->fp, ftell($this->fp) - 1);
			}

			$framedata = @unpack("a{$framedatasize}data", fread($this->fp, $framedatasize));
			$framedata = $framedata['data'];

			if($frameid == 'COMM') {
				$framelang = substr($framedata, 0, 3);
				$framedata = substr($framedata, 3 + ($framedata{3} == "\x00" ? 1 : 0));
			} else {
				$framelang = '';
			}

			$frame = array
				(
				'frameid' => $frameid,
				'description' => $framedescription,
				'flag' => array
					(
					'tag_protect' => $frameflag[0]{0},
					'file_protect' => $frameflag[0]{1},
					'readonly' => $frameflag[0]{2},
					'compressed' => $frameflag[1]{0},
					'encrypted' => $frameflag[1]{1},
					'group' => $frameflag[1]{2},
					),
				'size' => $framesize,
				'data' => $framedata
				);

			$framecharset && $frame['charset'] = $framecharset;
			$framelang && $frame['language'] = $framelang;

			$tag['frames'][$frameid][] = $frame;

		}

		if($this->id3v2) {
			if(!isset($this->id3v2[0])) {
				$id3v2 = $this->id3v2;
				$this->id3v2 = array($id3v2);
			}
			$this->id3v2[] = $tag;
		} else {
			$this->id3v2 = $tag;
		}

		$this->pos_audio_start = $pos_end;
		return true;

	}

	private function get_id3v1() {

		$tagsize = 128;
		$tagstart = $this->filesize - $tagsize;

		fseek($this->fp, $tagstart);

		$tagdata = fread($this->fp, $tagsize);
		$tag = @unpack('a3header/a30title/a30artist/a30album/a4year/a28comment/Creserve/Ctrack/Cgenre', $tagdata);

		if($tag['header'] == 'TAG') {
			$this->pos_audio_end = $this->filesize - $tagsize;
		} else {
			$this->pos_audio_end = $this->filesize;
			return false;
		}

		$tag['genre'] = $this->id3v1_genres[$tag['genre']];
		$tag['genre'] = $tag['genre'] ? $tag['genre'] : 'Unknown';

		unset($tag['header']);
		$this->id3v1 = $tag;

		return true;

	}

	private function get_data() {

		while(1) {

			fseek($this->fp, $this->pos_audio_start);
			$checkdata = fread($this->fp, 3);

			if($checkdata == "ID3") {
				if(!$this->get_id3v2()) {
					return false;
				}
			} else {
				fseek($this->fp, $this->pos_audio_start);
				break;
			}

		}

		$padding_data = fread($this->fp, 1024);
		$padding_size = @max(0, strpos($padding_data, trim($padding_data)));

		fseek($this->fp, $this->pos_audio_start + $padding_size);

		if($this->fileanalysis > 0) {

			if(!$framedata = $this->get_data_frames()) {
				return false;
			}

		} else {

			$first_frame_header_data = fread($this->fp, 4);
			$first_frame_header = $this->get_frameheader($first_frame_header_data);

			if(!$first_frame_header || !is_array($first_frame_header)) {
				return false;
			}

			$framedata = fread($this->fp, 36);
			$frametype = strpos($framedata, 'Xing') ? 'VBR' : 'CBR';

			if($frametype == 'CBR') {
				$frametotal = $this->get_data_cbr($first_frame_header);
			} else {
				$frametotal = $this->get_data_vbr($first_frame_header);
			}

			$framedata = $first_frame_header;
			unset($framedata['framesize']);

			$framedata['frametotal'] = $frametotal;
			$framedata['type'] = $frametype;

		}

		$framelength = $framedata['frametotal'] * 0.026;
		$frametime = $this->conv_time(round($framelength));

		$framedata['length'] = $framelength;
		$framedata['time'] = $frametime;
		$framedata['filesize'] = $this->filesize;

		$this->data = $framedata;
		return true;

	}

	private function get_data_frames() {

		$first_frame = array();
		$frame_total = 0;

		while(1) {

			$frameheaders = fread($this->fp, 4);
			$pos_frame = ftell($this->fp);

			if($pos_frame >= $this->pos_audio_end) {
				break;
			}

			if(!$frameheader = $this->get_frameheader($frameheaders)) {
				break;
			}

			$first_frame = $first_frame ? $first_frame : $frameheader;
			extract($frameheader);

			$this->bitrate_min = $this->bitrate_min > 0 ? min($this->bitrate_min, $bitrate) : $bitrate;
			$this->bitrate_max = max($this->bitrate_max, $bitrate);
			$this->bitrate_sum += $bitrate;

			if($this->fileanalysis > 1) {
				$this->audio_frames[] = array($pos_frame - 4, $bitrate, $framesize);
			}

			fseek($this->fp, $pos_frame + $framesize - 4);
			$frame_total++;

		}

		$first_frame['bitrate'] = @round($this->bitrate_sum / $frame_total);
		$first_frame['frametotal'] = $frame_total;

		if($this->bitrate_max != $this->bitrate_min) {
			$first_frame['bitrate_max'] = $this->bitrate_max;
			$first_frame['bitrate_min'] = $this->bitrate_min;
			$first_frame['type'] = 'VBR';
		} else {
			$first_frame['type'] = 'CBR';
		}

		unset($first_frame['framesize']);

		return $first_frame;

	}

	private function get_data_cbr($frameheader) {

		extract($frameheader);
		$audio_size = $this->pos_audio_end - $this->pos_audio_start;

		return @ceil($audio_size / $framesize);

	}

	private function get_data_vbr($frameheader) {

		$framevbrdata = @unpack('NVBR', fread($this->fp, 4));;
		$framevbrs = array(1, 3, 5, 7, 9, 11, 13, 15);

		if(!in_array($framevbrdata['VBR'], $framevbrs)) {
			return 0;
		}

		$frametotaldata = @unpack('Nframetotal', fread($this->fp, 4));
		$frametotal = $frametotaldata['frametotal'];

		return $frametotal;

	}

	function get_frameheader($frameheaders) {

		$frameheader = array();
		$frameheaderlength = 4;

		if(strlen($frameheaders) != $frameheaderlength) {
			return false;
		}

		for($i = 0; $i < $frameheaderlength; $i++) {
			$frameheader[] = $this->conv_flag(ord($frameheaders{$i}));
		}

		if($frameheaders{0} != "\xFF" || substr($frameheader[1], 0, 3) != '111') {
			return false;
		}

		switch(substr($frameheader[1], 3, 2)) {
			case '00': $mpegver = '2.5'; break;
			case '10': $mpegver = '2'; break;
			case '11': $mpegver = '1'; break;
			default: return false;
		}

		switch(substr($frameheader[1], 5, 2)) {
			case '01': $layer = '3'; break;
			case '10': $layer = '2'; break;
			case '11': $layer = '1'; break;
			default: return false;
		}

		$bitrate = substr($frameheader[2], 0, 4);
		$bitrate = $this->bitrates[$bitrate][intval($mpegver) - 1][intval($layer) - 1];

		$sampling_frequency = substr($frameheader[2], 4, 2);
		$sampling_frequency = $this->sampling_frequencys[$sampling_frequency][ceil($mpegver) - 1];

		if(!$bitrate || !$sampling_frequency) {
			return false;
		}

		$padding = $frameheader[2]{6};

		$mode = substr($frameheader[3], 0, 2);
		$mode = $this->modes[$mode];

		$mode_extension = substr($frameheader[3], 2, 2);
		$mode_extension = $this->mode_extensions[$mode_extension];

		if(!$mode || !$mode_extension) {
			return false;
		}

		$copyright = substr($frameheader[3], 4, 1) ? 1 : 0;
		$original = substr($frameheader[3], 5, 1) ? 1 : 0;

		switch($mpegver) {
			case '1':
				$definite = $layer == '1' ? 48 : 144;
				break;
			case '2': case '2.5':
				$definite = $layer == '1' ? 24 : 72;
				break;
			default:
				return false;
		}

		$framesize = intval($definite * $bitrate * 1000 / $sampling_frequency + intval($padding));

		return array
			(
			'mpegver' => $mpegver,
			'layer' => $layer,
			'bitrate' => $bitrate,
			'sampling_frequency' => $sampling_frequency,
			'padding' => $padding,
			'mode' => $mode,
			'mode_extension' => array
				(
				'Intensity_Stereo' => $mode_extension[0],
				'MS_Stereo' => $mode_extension[1]
				),
			'copyright' => $copyright,
			'original' => $original,
			'framesize' => $framesize
			);

	}

	function set_mp3($file_input, $file_output, $id3v2 = array(), $id3v1 = array()) {

		if(!$mp3 = $this->get_mp3($file_input)) {
			return false;
		}

		if(!$fp = @fopen($file_output, 'wb')) {
			return false;
		}

		$id3v2 = is_array($id3v2) ? $id3v2 : array();
		$id3v1 = is_array($id3v1) ? $id3v1 : array();

		$id3v2_data = $id3v1_data = '';
		fseek($this->fp, $this->pos_audio_start);

		$audio_length = $this->pos_audio_end - $this->pos_audio_start;
		$audio_data = fread($this->fp, $audio_length);

		foreach($id3v2 as $frameid => $frame) {

			if(strlen($frameid) != 4 || !is_array($frame)) {
				continue;
			}

			$frameid = strtoupper($frameid);
			$framecharset = 0;

			$frameflag = array
				(
				0 => bindec(($frame['tag_protect'] ? '1' : '0').($frame['file_protect'] ? '1' : '0').($frame['readonly'] ? '1' : '0').'00000'),
				1 => bindec(($frame['compressed'] ? '1' : '0').($frame['encrypted'] ? '1' : '0').($frame['group'] ? '1' : '0').'00000'),
				);

			if($frame['charset'] = strtolower($frame['charset'])) {
				switch($frame['charset']) {
					case 'UTF-16': $framecharset = 1; break;
					case 'UTF-16BE': $framecharset = 2; break;
					case 'UTF-8': $framecharset = 3; break;
				}
			}

			$framedata = chr($framecharset).$frame['data'];
			$framesize = strlen($framedata);

			$id3v2_data .= pack('a4NCCa'.$framesize, $frameid, $framesize, $frameflag[0], $frameflag[1], $framedata);

		}

		if($id3v2_data) {

			$id3v2_flag = bindec(($id3v2['unsynchronisation'] ? '1' : '0').($id3v2['extra'] ? '1' : '0').($id3v2['istest'] ? '1' : '0').'00000');
			$id3v2_size = strlen($id3v2_data) + 10;

			$id3v2_sizes = array
				(
				0 => ($id3v2_size >> 21) & 0x7F,
				1 => ($id3v2_size >> 14) & 0x7F,
				2 => ($id3v2_size >> 7) & 0x7F,
				3 => $id3v2_size & 0x7F
				);

			$id3v2_header = pack('a3CCC', 'ID3', 3, 0, $id3v2_flag);
			$id3v2_header .= pack('CCCC', $id3v2_sizes[0], $id3v2_sizes[1], $id3v2_sizes[2], $id3v2_sizes[3]);

			$audio_data = $id3v2_header.$id3v2_data.$audio_data;

		}

		if($id3v1) {
			$id3v1_data = pack('a3a30a30a30a4a28CCC', 'TAG', $id3v1['title'], $id3v1['artist'], $id3v1['album'], $id3v1['year'], $id3v1['comment'], intval($id3v1['reserve']), intval($id3v1['track']), intval($id3v1['genre']));
			$audio_data .= $id3v1_data;
		}

		fwrite($fp, $audio_data);
		fclose($fp);

		return true;

	}

	function cut_mp3($file_input, $file_output, $startindex = 0, $endindex = -1, $indextype = 'frame', $cleantags = false) {

		if(!in_array($indextype, array('frame', 'second', 'percent'))) {
			return false;
		}

		if(!$mp3 = $this->get_mp3($file_input, true, true)) {
			return false;
		}

		if(!$mp3['data'] || !$mp3['frames']) {
			return false;
		}

		if(!$fp = @fopen($file_output, 'wb')) {
			return false;
		}

		$indexs = $mp3['frames'];
		$indextotal = count($mp3['frames']);

		$cutdata = '';
		$maxendindex = $indextotal - 1;

		if($indextype == 'second') {
			$startindex = ceil($startindex * (1 / 0.026));
			$endindex = $endindex > 0 ? ceil($endindex * (1 / 0.026)) : -1;
		} elseif ($indextype == 'percent') {
			$startindex = round($maxendindex * $startindex);
			$endindex = $endindex > 0 ? round($maxendindex * $endindex) : -1;
		}

		if($startindex < 0 || $start > $maxendindex) {
			return false;
		}

		$endindex = $endindex < 0 ? $maxendindex : $endindex;
		$endindex = min($endindex, $maxendindex);

		if($endindex <= $startindex) {
			return false;
		}

		$pos_start = $indexs[$startindex][0];
		$pos_end = $indexs[$endindex][0] + $indexs[$endindex][2];

		fseek($this->fp, $pos_start);
		$cutdata = fread($this->fp, $pos_end - $pos_start);

		if($mp3['data']['type'] == 'VBR') {

			fseek($this->fp, $indexs[0][0]);
			$frame = fread($this->fp, $indexs[0][2]);

			if(strpos($frame, 'Xing')) {

				$cutdata = substr($cutdata, $indexs[0][2]);

				$newvbr = substr($frame, 0, 4);
				$newvbr_sign_padding = 0;

				if($mp3['data']['mpegver'] == 1) {
					$newvbr_sign_padding = $mp3['data']['mode'] == $this->modes['11'] ? 16 : 31;
				} else if($mp3['data']['mpegver'] == 2) {
					$newvbr_sign_padding = $mp3['data']['mode'] == $this->modes['11'] ? 8 : 16;
				}

				if($newvbr_sign_padding) {

					$newvbr .= pack("a{$newvbr_sign_padding}a4", null, 'Xing');
					$newvbr .= pack('a'.(32 - $newvbr_sign_padding), null);
					$newvbr .= pack('NNNa100N', 1, $endindex - $startindex + 1, 0, null, 0);

					$newvbr .= pack('a'.($indexs[0][2] - strlen($newvbr)), null);
					$cutdata = $newvbr.$cutdata;

				}

			}

		}

		if(!$cleantags) {

			rewind($this->fp);

			if($this->pos_audio_start != 0) {
				$cutdata = fread($this->fp, $this->pos_audio_start).$cutdata;
			}

			if($this->pos_audio_end != $this->filesize) {
				fseek($this->fp, $this->pos_audio_end);
				$cutdata .= fread($this->fp, 128);
			}

		}

		fwrite($fp, $cutdata);
		fclose($fp);

		return true;

	}

	function conv_flag($flag, $convtobin = true, $length = 8) {

		$flag = $convtobin ? decbin($flag) : $flag;
		$recruit = $length - strlen($flag);

		if($recruit < 1) {
			return $flag;
		}

		return sprintf('%0'.$length.'d', $flag);

	}

	function conv_time($seconds) {

		$return = '';
		$separator = ':';

		if($seconds > 3600) {
			$return .= intval($seconds / 3600).' ';
			$seconds -= intval($seconds / 3600) * 3600;
		}

		if($seconds > 60) {
			$return .= sprintf('%02d', intval($seconds / 60)).' ';
			$seconds -= intval($seconds / 60) * 60;
		} else {
			$return .= '00 ';
		}

		$return .= sprintf('%02d', $seconds);
		$return = trim($return);

		return str_replace(' ', $separator, $return);

	}

}


class mp3file
{
    protected $block;
    protected $blockpos;
    protected $blockmax;
    protected $blocksize;
    protected $fd;
    protected $bitpos;
    protected $mp3data;
    public function __construct($params)
    {
		$filename = $params['file_name'];
		$this->powarr  = array(0=>1,1=>2,2=>4,3=>8,4=>16,5=>32,6=>64,7=>128);
        $this->blockmax= 1024;
       
        $this->mp3data = array();
        $this->mp3data['Filesize'] = filesize($filename);

        $this->fd = fopen($filename,'rb');
        $this->prefetchblock();
        $this->readmp3frame();
    }
    public function __destruct()
    {
        fclose($this->fd);
    }
    //-------------------
    public function get_metadata()
    {
        return $this->mp3data;
    }
    protected function readmp3frame()
    {
        $iscbrmp3=true;
        if ($this->startswithid3())
            $this->skipid3tag();
        else if ($this->containsvbrxing())
        {
            $this->mp3data['Encoding'] = 'VBR';
            $iscbrmp3=false;
        }
        else if ($this->startswithpk())
        {
            $this->mp3data['Encoding'] = 'Unknown';
            $iscbrmp3=false;
        }
   
        if ($iscbrmp3)
        {
            $i = 0;
            $max=5000;
            //look in 5000 bytes...
            //the largest framesize is 4609bytes(256kbps@8000Hz  mp3)
            for($i=0; $i<$max; $i++)
            {
                //looking for 1111 1111 111 (frame synchronization bits)                
                if ($this->getnextbyte()==0xFF)
                    if ($this->getnextbit() && $this->getnextbit() && $this->getnextbit())
                        break;
            }
            if ($i==$max)
                $iscbrmp3=false;
        }
   
        if ($iscbrmp3)
        {
            $this->mp3data['Encoding'         ] = 'CBR';
            $this->mp3data['MPEG version'     ] = $this->getnextbits(2);
            $this->mp3data['Layer Description'] = $this->getnextbits(2);
            $this->mp3data['Protection Bit'   ] = $this->getnextbits(1);
            $this->mp3data['Bitrate Index'    ] = $this->getnextbits(4);
            $this->mp3data['Sampling Freq Idx'] = $this->getnextbits(2);
            $this->mp3data['Padding Bit'      ] = $this->getnextbits(1);
            $this->mp3data['Private Bit'      ] = $this->getnextbits(1);
            $this->mp3data['Channel Mode'     ] = $this->getnextbits(2);
            $this->mp3data['Mode Extension'   ] = $this->getnextbits(2);
            $this->mp3data['Copyright'        ] = $this->getnextbits(1);
            $this->mp3data['Original Media'   ] = $this->getnextbits(1);
            $this->mp3data['Emphasis'         ] = $this->getnextbits(1);
            $this->mp3data['Bitrate'          ] = mp3file::bitratelookup($this->mp3data);
            $this->mp3data['Sampling Rate'    ] = mp3file::samplelookup($this->mp3data);
            $this->mp3data['Frame Size'       ] = mp3file::getframesize($this->mp3data);
            $this->mp3data['Length'           ] = mp3file::getduration($this->mp3data,$this->tell2());
            $this->mp3data['Length mm:ss'     ] = mp3file::seconds_to_mmss($this->mp3data['Length']);
           
            if ($this->mp3data['Bitrate'      ]=='bad'     ||
                $this->mp3data['Bitrate'      ]=='free'    ||
                $this->mp3data['Sampling Rate']=='unknown' ||
                $this->mp3data['Frame Size'   ]=='unknown' ||
                $this->mp3data['Length'     ]=='unknown')
            $this->mp3data = array('Filesize'=>$this->mp3data['Filesize'], 'Encoding'=>'Unknown');
        }
        else
        {
            if(!isset($this->mp3data['Encoding']))
                $this->mp3data['Encoding'] = 'Unknown';
        }
    }
    protected function tell()
    {
        return ftell($this->fd);
    }
    protected function tell2()
    {
        return ftell($this->fd)-$this->blockmax +$this->blockpos-1;
    }
    protected function startswithid3()
    {
        return ($this->block[1]==73 && //I
                $this->block[2]==68 && //D
                $this->block[3]==51);  //3
    }
    protected function startswithpk()
    {
        return ($this->block[1]==80 && //P
                $this->block[2]==75);  //K
    }
    protected function containsvbrxing()
    {
        //echo "<!--".$this->block[37]." ".$this->block[38]."-->";
        //echo "<!--".$this->block[39]." ".$this->block[40]."-->";
        return(
               ($this->block[37]==88  && //X 0x58
                $this->block[38]==105 && //i 0x69
                $this->block[39]==110 && //n 0x6E
                $this->block[40]==103)   //g 0x67
/*               ||
               ($this->block[21]==88  && //X 0x58
                $this->block[22]==105 && //i 0x69
                $this->block[23]==110 && //n 0x6E
                $this->block[24]==103)   //g 0x67*/
              );  

    }
    protected function debugbytes()
    {
        for($j=0; $j<10; $j++)
        {
            for($i=0; $i<8; $i++)
            {
                if ($i==4) echo " ";
                echo $this->getnextbit();
            }
            echo "<BR>";
        }
    }
    protected function prefetchblock()
    {
        $block = fread($this->fd, $this->blockmax);
        $this->blocksize = strlen($block);
        $this->block = unpack("C*", $block);
        $this->blockpos=0;
    }
    protected function skipid3tag()
    {
        $bits=$this->getnextbits(24);//ID3
        $bits.=$this->getnextbits(24);//v.v flags

        //3 bytes 1 version byte 2 byte flags
        $arr = array();
        $arr['ID3v2 Major version'] = bindec(substr($bits,24,8));
        $arr['ID3v2 Minor version'] = bindec(substr($bits,32,8));
        $arr['ID3v2 flags'        ] = bindec(substr($bits,40,8));
        if (substr($bits,40,1)) $arr['Unsynchronisation']=true;
        if (substr($bits,41,1)) $arr['Extended header']=true;
        if (substr($bits,42,1)) $arr['Experimental indicator']=true;
        if (substr($bits,43,1)) $arr['Footer present']=true;

        $size = "";
        for($i=0; $i<4; $i++)
        {
            $this->getnextbit();//skip this bit, should be 0
            $size.= $this->getnextbits(7);
        }

        $arr['ID3v2 Tags Size']=bindec($size);//now the size is in bytes;
        if ($arr['ID3v2 Tags Size'] - $this->blockmax>0)
        {
            fseek($this->fd, $arr['ID3v2 Tags Size']+10 );
            $this->prefetchblock();
            if (isset($arr['Footer present']) && $arr['Footer present'])
            {
                for($i=0; $i<10; $i++)
                    $this->getnextbyte();//10 footer bytes
            }
        }
        else
        {
            for($i=0; $i<$arr['ID3v2 Tags Size']; $i++)
                $this->getnextbyte();
        }
    }

    protected function getnextbit()
    {
        if ($this->bitpos==8)
            return false;

        $b=0;
        $whichbit = 7-$this->bitpos;
        $mult = $this->powarr[$whichbit]; //$mult = pow(2,7-$this->pos);
        $b = $this->block[$this->blockpos+1] & $mult;
        $b = $b >> $whichbit;
        $this->bitpos++;

        if ($this->bitpos==8)
        {
            $this->blockpos++;
               
            if ($this->blockpos==$this->blockmax) //end of block reached
            {
                $this->prefetchblock();
            }
            else if ($this->blockpos==$this->blocksize)
            {//end of short block reached (shorter than blockmax)
                return;//eof
            }
           
            $this->bitpos=0;
        }
        return $b;
    }
    protected function getnextbits($n=1)
    {
        $b="";
        for($i=0; $i<$n; $i++)
            $b.=$this->getnextbit();
        return $b;
    }
    protected function getnextbyte()
    {
        if ($this->blockpos>=$this->blocksize)
            return;

        $this->bitpos=0;
        $b=$this->block[$this->blockpos+1];
        $this->blockpos++;
        return $b;
    }
    //-----------------------------------------------------------------------------
    public static function is_layer1(&$mp3) { return ($mp3['Layer Description']=='11'); }
    public static function is_layer2(&$mp3) { return ($mp3['Layer Description']=='10'); }
    public static function is_layer3(&$mp3) { return ($mp3['Layer Description']=='01'); }
    public static function is_mpeg10(&$mp3)  { return ($mp3['MPEG version']=='11'); }
    public static function is_mpeg20(&$mp3)  { return ($mp3['MPEG version']=='10'); }
    public static function is_mpeg25(&$mp3)  { return ($mp3['MPEG version']=='00'); }
    public static function is_mpeg20or25(&$mp3)  { return ($mp3['MPEG version']{1}=='0'); }
    //-----------------------------------------------------------------------------
    public static function bitratelookup(&$mp3)
    {
        //bits               V1,L1  V1,L2  V1,L3  V2,L1  V2,L2&L3
        $array = array();
        $array['0000']=array('free','free','free','free','free');
        $array['0001']=array(  '32',  '32',  '32',  '32',   '8');
        $array['0010']=array(  '64',  '48',  '40',  '48',  '16');
        $array['0011']=array(  '96',  '56',  '48',  '56',  '24');
        $array['0100']=array( '128',  '64',  '56',  '64',  '32');
        $array['0101']=array( '160',  '80',  '64',  '80',  '40');
        $array['0110']=array( '192',  '96',  '80',  '96',  '48');
        $array['0111']=array( '224', '112',  '96', '112',  '56');
        $array['1000']=array( '256', '128', '112', '128',  '64');
        $array['1001']=array( '288', '160', '128', '144',  '80');
        $array['1010']=array( '320', '192', '160', '160',  '96');
        $array['1011']=array( '352', '224', '192', '176', '112');
        $array['1100']=array( '384', '256', '224', '192', '128');
        $array['1101']=array( '416', '320', '256', '224', '144');
        $array['1110']=array( '448', '384', '320', '256', '160');
        $array['1111']=array( 'bad', 'bad', 'bad', 'bad', 'bad');
       
        $whichcolumn=-1;
        if      (mp3file::is_mpeg10($mp3) && mp3file::is_layer1($mp3) )//V1,L1
            $whichcolumn=0;
        else if (mp3file::is_mpeg10($mp3) && mp3file::is_layer2($mp3) )//V1,L2
            $whichcolumn=1;
        else if (mp3file::is_mpeg10($mp3) && mp3file::is_layer3($mp3) )//V1,L3
            $whichcolumn=2;
        else if (mp3file::is_mpeg20or25($mp3) && mp3file::is_layer1($mp3) )//V2,L1
            $whichcolumn=3;
        else if (mp3file::is_mpeg20or25($mp3) && (mp3file::is_layer2($mp3) || mp3file::is_layer3($mp3)) )
            $whichcolumn=4;//V2,   L2||L3
       
        if (isset($array[$mp3['Bitrate Index']][$whichcolumn]))
            return $array[$mp3['Bitrate Index']][$whichcolumn];
        else
            return "bad";
    }
    //-----------------------------------------------------------------------------
    public static function samplelookup(&$mp3)
    {
        //bits               MPEG1   MPEG2   MPEG2.5
        $array = array();
        $array['00'] =array('44100','22050','11025');
        $array['01'] =array('48000','24000','12000');
        $array['10'] =array('32000','16000','8000');
        $array['11'] =array('res','res','res');
       
        $whichcolumn=-1;
        if      (mp3file::is_mpeg10($mp3))
            $whichcolumn=0;
        else if (mp3file::is_mpeg20($mp3))
            $whichcolumn=1;
        else if (mp3file::is_mpeg25($mp3))
            $whichcolumn=2;
       
        if (isset($array[$mp3['Sampling Freq Idx']][$whichcolumn]))
            return $array[$mp3['Sampling Freq Idx']][$whichcolumn];
        else
            return 'unknown';
    }
    //-----------------------------------------------------------------------------
    public static function getframesize(&$mp3)
    {
        if ($mp3['Sampling Rate']>0)
        {
            return  ceil((144 * $mp3['Bitrate']*1000)/$mp3['Sampling Rate']) + $mp3['Padding Bit'];
        }
        return 'unknown';
    }
    //-----------------------------------------------------------------------------
    public static function getduration(&$mp3,$startat)
    {
        if ($mp3['Bitrate']>0)
        {
            $KBps = ($mp3['Bitrate']*1000)/8;
            $datasize = ($mp3['Filesize'] - ($startat/8));
            $length = $datasize / $KBps;
            return sprintf("%d", $length);
        }
        return "unknown";
    }
    //-----------------------------------------------------------------------------
    public static function seconds_to_mmss($duration)
    {
        return sprintf("%d:%02d", ($duration /60), $duration %60 );
    }
}
?>

<?php
$f = '../users/146/sound/Alex_Barattini_-_The_Cha_Cha5.mp3';
//$f = '../users/146/sound/GameJAM-bitcheeeezz.mp3';
//$mp3 = new mp3file(array('file_name' => $f));
//print_r($mp3->get_metadata()); 
$mp3 = new mp3; 

/* 

    get the data of mp3 file: 

        mp3::get_mp3($filepath, $analysis = false, $getframesindex = false) 
        it will return an array or false 

*/ 
print_r($mp3->get_mp3($f, true)); 






?>