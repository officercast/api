<?php
/**
 *  This file is part of the Podcast Crawler package.
 *
 *  Copyright (c) 2016 Dorian Neto
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace PodcastCrawler;

/**
 * Class Podcastcrawler\Request
 *
 * @version v0.15.1-beta
 * @link https://github.com/podcastcrawler/podcastcrawler
 * @license https://github.com/podcastcrawler/podcastcrawler/blob/master/LICENSE.md MIT
 * @copyright 2016 Podcast Crawler
 * @author Dorian Neto <doriansampaioneto@gmail.com>
 */
class Request
{
    /**
     * Status code of the HTTP request
     * @var int $statusCode
     */
    private $statusCode = null;

    /**
     * Makes a HTTP request
     * @param string $url URL to be requested
     * @param array $options CURL options
     * @return string
     */
    public function request($url, array $options = [])
    {
        $request = curl_init($url);

        $default_options = [
            CURLOPT_FAILONERROR    => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLINFO_HEADER_OUT    => true
        ] + $options;

        curl_setopt_array($request, $default_options);

        $result = curl_exec($request);
        $this->statusCode = curl_getinfo($request, CURLINFO_HTTP_CODE);
        curl_close($request);

        return $result;
    }

    /**
     * Returns the HTTP status code
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}