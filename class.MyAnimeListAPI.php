<?php
/**
 * @author	Semicolon;
 * @github	https://github.com/semicolonsmith/MyAnimeList-API
 * @date	17 Juli 2017
 * @version	3.0
 **/

class MyAnimeListAPI{
	public static function curl($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) ChromeHD/52.0.2743.82 Safari/537.36');
		$exec = curl_exec($ch);
		$exec = str_replace(urldecode('%0A'), '', $exec);
		return $exec;
	}
	public static function get_data($url){
		if(strpos($url, "/anime/") == true){
			# Kata Kunci
			$tidakAdaLatarBelakang = "No background information has been added to this title.";
			$tidakAdaPembuka = "No opening themes have been added to this title.";
			$tidakAdaPenutup = "No ending themes have been added to this title.";
			# Mengambil Konten URL dan Membuat Struktur untuk Hasilnya
			$konten = self::curl($url);
			$hasil  = array();
			# Mengambil URL Thumbnail / Gambar
			preg_match("'<img src=\"\s*(?P<url>\S+)\s*\" alt=\"(.*?)\" class=\"ac\" itemprop=\"image\">'si", $konten, $gambar);
			if(isset($gambar["url"])) $hasil["image"] = $gambar["url"];
			if(isset($gambar[2])) $hasil["title"] = $gambar[2];
			# Mengambil URL Promotional Video
			preg_match("'<div class=\"video-promotion\"><a class=\"iframe js-fancybox-video video-unit promotion\" href=\"\s*(?P<url>\S+)\s*\"(.*?)>(.*?)</a>'si", $konten, $vidioPromosi);
			if(isset($vidioPromosi["url"])) $hasil["pv"] = $vidioPromosi["url"];
			# Mengambil data "Details" kemudian di Filter
			preg_match("'<span itemprop=\"description\">\s*(.*?)\s*</span>'si", $konten, $sinopsis);
			if(isset($sinopsis[1])) 
		$synoptrsl ='https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=id&dt=t&q='.urlencode($sinopsis[1]);
	$file1 = file_get_contents($synoptrsl);	
	$ura = str_replace(array('","','[[["','3],["','[','Ditulis oleh MAL Rewrite',']','Written by MAL Rewrite','",null,null,3,null,"en"'),array('<tag>','','</tag>','','','','',''),$file1);
$tes= preg_replace('#(<tag.*?>).*?(</tag>)#', '$1$2', $ura);
$tes= preg_replace('#<[^>]*>#', '$1$2', $tes);
$tes1= str_replace(array('\\','/','u003cbr u003eru003cbr u003er'),array('','',''),$tes);
$hasil ["synopsisid"] = $tes1;
		$hasil["synopsis"] = $sinopsis[1];
			preg_match("'</div>Background</h2>\s*(.*?)\s*<div class=\"border_top\"'si", $konten, $latarBelakang);
			if(isset($latarBelakang[1])){
				if(preg_match("'(.*?)\s*Help improve our'si", $latarBelakang[1])){
					$hasil["background"] = $tidakAdaLatarBelakang;
				}else{
					$hasil["background"] = $latarBelakang[1];
				}
			}
			# Mengambil data "Alternate Title" kemudian di Filter
			preg_match("'English:</span>\s*(.*?)\s*</div>'si", $konten, $inggris);
			if(isset($inggris[1])) $hasil["english"] = $inggris[1];
			preg_match("'Japanese:</span>\s*(.*?)\s*</div>'si", $konten, $jepang);
			if(isset($jepang[1])) $hasil["japanese"] = $jepang[1];
			preg_match("'Synonyms:</span>\s*(.*?)\s*</div>'si", $konten, $sinonim);
			if(isset($sinonim[1])) $hasil["synonyms"] = $sinonim[1];
			# Mengambil data "Information" kemudian di Filter
			preg_match("'Type:</span>\s*(.*?)\s*</div>'si", $konten, $tipe);
			if(isset($tipe[1])){
				if(preg_match("'>\s*(.*?)\s*</a>'si", $tipe[1])){
					preg_match("'>\s*(.*?)\s*</a>'si", $tipe[1], $filterTipe);
					$hasil["type"] = $filterTipe[1];
				}else{
					$hasil["type"] = $tipe[1];
				}
			}
			preg_match("'Episodes:</span>\s*(.*?)\s*</div>'si", $konten, $episode);
			if(isset($episode[1])) $hasil["episodes"] = $episode[1];
			preg_match("'Status:</span>\s*(.*?)\s*</div>'si", $konten, $status);
			if(isset($status[1])) $hasil["status"] = $status[1];
			preg_match("'Aired:</span>\s*(.*?)\s*</div>'si", $konten, $ditayangkan);
			if(isset($ditayangkan[1])) $hasil["aired"] = $ditayangkan[1];
			preg_match("'Premiered:</span>\s*(.*?)\s*</div>'si", $konten, $musim);
			if(isset($musim[1])){
				if(preg_match("'>\s*(.*?)\s*</a>'si", $musim[1])){
					preg_match("'>\s*(.*?)\s*</a>'si", $musim[1], $filterMusim);
					$hasil["premiered"] = $filterMusim[1];
				}else{
					$hasil["premiered"] = $musim[1];
				}
			}
			preg_match("'Broadcast:</span>\s*(.*?)\s*</div>'si", $konten, $disiarkan);
			if(isset($disiarkan[1])) $hasil["broadcast"] = $disiarkan[1];
			preg_match("'Producers:</span>\s*(.*?)\s*</div>'si", $konten, $produser);
			if(isset($produser[1])){
				if(preg_match_all("'>\s*(.*?)\s*</a>'si", $produser[1])){
					preg_match_all("'>\s*(.*?)\s*</a>'si", $produser[1], $filterProduser);
					$hasil["producers"] = ($filterProduser[1][0] == "add some") ? "None Found" : implode(", ", $filterProduser[1]);
				}else{
					$hasil["producers"] = $produser[1];
				}
			}
			preg_match("'Licensors:</span>\s*(.*?)\s*</div>'si", $konten, $lisensi);
			if(isset($lisensi[1])){
				if(preg_match_all("'>\s*(.*?)\s*</a>'si", $lisensi[1])){
					preg_match_all("'>\s*(.*?)\s*</a>'si", $lisensi[1], $filterLisensi);
					$hasil["licensors"] = ($filterLisensi[1][0] == "add some") ? "None Found" : implode(", ", $filterLisensi[1]);
				}else{
					$hasil["licensors"] = $lisensi[1];
				}
			}
			preg_match("'Studios:</span>\s*(.*?)\s*</div>'si", $konten, $studio);
			if(isset($studio[1])){
				if(preg_match_all("'>\s*(.*?)\s*</a>'si", $studio[1])){
					preg_match_all("'>\s*(.*?)\s*</a>'si", $studio[1], $filterStudio);
					$hasil["studios"] = ($filterStudio[1][0] == "add some") ? "None Found" : implode(", ", $filterStudio[1]);
				}else{
					$hasil["studios"] = $studio[1];
				}
			}
			preg_match("'Source:</span>\s*(.*?)\s*</div>'si", $konten, $sumber);
			if(isset($sumber[1])) $hasil["source"] = $sumber[1];
			preg_match("'Genres:</span>\s*(.*?)\s*</div>'si", $konten, $genre);
			if(isset($genre[1])){
				if(preg_match_all("'>\s*(.*?)\s*</a>'si", $genre[1])){
					preg_match_all("'>\s*(.*?)\s*</a>'si", $genre[1], $filterGenre);
					$hasil["genres"] = implode(", ", $filterGenre[1]);
				}else{
					$hasil["genres"] = $genre[1];
				}
			}
			preg_match("'Duration:</span>\s*(.*?)\s*</div>'si", $konten, $durasi);
			if(isset($durasi[1])) $hasil["duration"] = $durasi[1];
			preg_match("'Rating:</span>\s*(.*?)\s*</div>'si", $konten, $rating);
			if(isset($rating[1])) $hasil["rating"] = $rating[1];
			# Mengambil data "Statistics" kemudian di Filter
			preg_match("'<span itemprop=\"ratingValue\">\s*(.*?)\s*</span>'si", $konten, $nilaiSkor);
			if(isset($nilaiSkor[1])) $hasil["score"] = $nilaiSkor[1];
			preg_match("'Ranked:</span>\s*(.*?)\s*<'si", $konten, $rangking);
			if(isset($rangking[1])) $hasil["ranked"] = $rangking[1];
			preg_match("'Popularity:</span>\s*(.*?)\s*<'si", $konten, $popularitas);
			if(isset($popularitas[1])) $hasil["popularity"] = $popularitas[1];
			preg_match("'Members:</span>\s*(.*?)\s*<'si", $konten, $anggota);
			if(isset($anggota[1])) $hasil["members"] = $anggota[1];
			preg_match("'Favorites:</span>\s*(.*?)\s*<'si", $konten, $favorit);
			if(isset($favorit[1])) $hasil["favorites"] = $favorit[1];
			# Mengambil data "Opening Theme" dan "Ending Theme"
			preg_match("'<div class=\"theme-songs js-theme-songs opnening\">\s*(.*?)\s*</div>'si", $konten, $pembuka);
			if(isset($pembuka[1])){
				if(preg_match_all("'<span class=\"theme-song\">\s*(.*?)\s*</span>'si", $pembuka[1])){
					preg_match_all("'<span class=\"theme-song\">\s*(.*?)\s*</span>'si", $pembuka[1], $filterPembuka);
					if(preg_match("'(.*?)\s*Help improve our'si", $filterPembuka[1][0])){
						$hasil["opening"] = $tidakAdaPembuka;
					}else{
						$hasil["opening"] = implode(", ", $filterPembuka[1]);
					}
				}else{
					if(preg_match("'(.*?)\s*Help improve our'si", $pembuka[1])){
						$hasil["opening"] = $tidakAdaPembuka;
					}else{
						$hasil["opening"] = $pembuka[1];
					}
				}
			}
			preg_match("'<div class=\"theme-songs js-theme-songs ending\">\s*(.*?)\s*</div>'si", $konten, $penutup);
			if(isset($penutup[1])){
				if(preg_match_all("'<span class=\"theme-song\">\s*(.*?)\s*</span>'si", $penutup[1])){
					preg_match_all("'<span class=\"theme-song\">\s*(.*?)\s*</span>'si", $penutup[1], $filterPenutup);
					if(preg_match("'(.*?)\s*Help improve our'si", $filterPenutup[1][0])){
						$hasil["ending"] = $tidakAdaPenutup;
					}else{
						$hasil["ending"] = implode(", ", $filterPenutup[1]);
					}
				}else{
					if(preg_match("'(.*?)\s*Help improve our'si", $penutup[1])){
						$hasil["ending"] = $tidakAdaPenutup;
					}else{
						$hasil["ending"] = $penutup[1];
					}
				}
			}
			return $hasil;
		}elseif(strpos($url, "/manga/") == true){
			# Kata Kunci
			$tidakAdaLatarBelakang = "No background information has been added to this title.";
			# Mengambil Konten URL dan Membuat Struktur untuk Hasilnya
			$konten = self::curl($url);
			$hasil  = array();
			# Mengambil URL Thumbnail / Gambar
			preg_match("'<img src=\"\s*(?P<url>\S+)\s*\" alt=\"(.*?)\" itemprop=\"image\" class=\"ac\">'si", $konten, $gambar);
			if(isset($gambar["url"])) $hasil["image"] = $gambar["url"];
			if(isset($gambar[2])) $hasil["title"] = $gambar[2];
			# Mengambil data "Details" kemudian di Filter
			preg_match("'<span itemprop=\"description\">\s*(.*?)\s*</span>'si", $konten, $sinopsis);
			if(isset($sinopsis[1])) $hasil["synopsis"] = $sinopsis[1];
			preg_match("'</div>Background</h2>\s*(.*?)\s*<div class=\"border_top\"'si", $konten, $latarBelakang);
			if(isset($latarBelakang[1])){
				if(preg_match("'(.*?)\s*Help improve our'si", $latarBelakang[1])){
					$hasil["background"] = $tidakAdaLatarBelakang;
				}else{
					$hasil["background"] = $latarBelakang[1];
				}
			}
			# Mengambil data "Alternate Title" kemudian di Filter
			preg_match("'English:</span>\s*(.*?)\s*</div>'si", $konten, $inggris);
			if(isset($inggris[1])) $hasil["english"] = $inggris[1];
			preg_match("'Japanese:</span>\s*(.*?)\s*</div>'si", $konten, $jepang);
			if(isset($jepang[1])) $hasil["japanese"] = $jepang[1];
			# Mengambil data "Information" kemudian di Filter
			preg_match("'Type:</span>\s*(.*?)\s*</div>'si", $konten, $tipe);
			if(isset($tipe[1])){
				if(preg_match("'>\s*(.*?)\s*</a>'si", $tipe[1])){
					preg_match("'>\s*(.*?)\s*</a>'si", $tipe[1], $filterTipe);
					$hasil["type"] = $filterTipe[1];
				}else{
					$hasil["type"] = $tipe[1];
				}
			}
			preg_match("'Volumes:</span>\s*(.*?)\s*</div>'si", $konten, $volume);
			if(isset($volume[1])) $hasil["volumes"] = $volume[1];
			preg_match("'Chapters:</span>\s*(.*?)\s*</div>'si", $konten, $chapter);
			if(isset($chapter[1])) $hasil["chapters"] = $chapter[1];
			preg_match("'Status:</span>\s*(.*?)\s*</div>'si", $konten, $status);
			if(isset($status[1])) $hasil["status"] = $status[1];
			preg_match("'Published:</span>\s*(.*?)\s*</div>'si", $konten, $dipublikasikan);
			if(isset($dipublikasikan[1])) $hasil["published"] = $dipublikasikan[1];
			preg_match("'Genres:</span>\s*(.*?)\s*</div>'si", $konten, $genre);
			if(isset($genre[1])){
				if(preg_match_all("'>\s*(.*?)\s*</a>'si", $genre[1])){
					preg_match_all("'>\s*(.*?)\s*</a>'si", $genre[1], $filterGenre);
					$hasil["genres"] = implode(", ", $filterGenre[1]);
				}else{
					$hasil["genres"] = $genre[1];
				}
			}
			preg_match("'Authors:</span>\s*(.*?)\s*</div>'si", $konten, $author);
			if(isset($author[1])){
				if(preg_match_all("'>\s*(.*?)\s*</a>'si", $author[1])){
					preg_match_all("'>\s*(.*?)\s*</a>'si", $author[1], $filterAuthor);
					$hasil["authors"] = implode(", ", $filterAuthor[1]);
				}else{
					$hasil["authors"] = $author[1];
				}
			}
			# Mengambil data "Statistics" kemudian di Filter
			preg_match("'<span itemprop=\"ratingValue\">\s*(.*?)\s*</span>'si", $konten, $nilaiSkor);
			if(isset($nilaiSkor[1])) $hasil["score"] = $nilaiSkor[1];
			preg_match("'Ranked:</span>\s*(.*?)\s*<'si", $konten, $rangking);
			if(isset($rangking[1])) $hasil["ranked"] = $rangking[1];
			preg_match("'Popularity:</span>\s*(.*?)\s*<'si", $konten, $popularitas);
			if(isset($popularitas[1])) $hasil["popularity"] = $popularitas[1];
			preg_match("'Members:</span>\s*(.*?)\s*<'si", $konten, $anggota);
			if(isset($anggota[1])) $hasil["members"] = $anggota[1];
			preg_match("'Favorites:</span>\s*(.*?)\s*<'si", $konten, $favorit);
			if(isset($favorit[1])) $hasil["favorites"] = $favorit[1];
			return $hasil;
		}
	}
}
?>