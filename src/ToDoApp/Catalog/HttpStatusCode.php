<?php

namespace ToDoApp\Catalog;

/**
 * Class HttpStatusCode
 */
class HttpStatusCode
{
    public const CONTINUE = 100;
    public const SWITCHING_PROTOCOLS = 101;
    public const PROCESSING = 102;
    public const EARLY_HINTS = 103;

    public const OK = 200;
    public const CREATED = 201;
    public const ACCEPTED = 202;
    public const NONAUTHORITATIVE_INFORMATION = 203;
    public const NO_CONTENT = 204;
    public const RESET_CONTENT = 205;
    public const PARTIAL_CONTENT = 206;
    public const MULTI_STATUS = 207;
    public const ALREADY_REPORTED = 208;
    public const IM_USED = 226;

    public const MULTIPLE_CHOICES = 300;
    public const MOVED_PERMANENTLY = 301;
    public const FOUND = 302;
    public const SEE_OTHER = 303;
    public const NOT_MODIFIED = 304;
    public const USE_PROXY = 305;
    public const SWITCH_PROXY = 306;
    public const TEMPORARY_REDIRECT = 307;
    public const PERMANENT_REDIRECT = 308;

    public const BAD_REQUEST = 400;
    public const UNAUTHORIZED = 401;
    public const PAYMENT_REQUIRED = 402;
    public const FORBIDDEN = 403;
    public const NOT_FOUND = 404;
    public const METHOD_NOT_ALLOWED = 405;
    public const NOT_ACCEPTABLE = 406;
    public const PROXY_AUTHENTICATION_REQUIRED = 407;
    public const REQUEST_TIMEOUT = 408;
    public const CONFLICT = 409;
    public const GONE = 410;
    public const LENGTH_REQUIRED = 411;
    public const PRECONDITION_FAILED = 412;
    public const PAYLOAD_TOO_LARGE = 413;
    public const URI_TOO_LONG = 414;
    public const UNSUPPORTED_MEDIA_TYPE = 415;
    public const RANGE_NOT_SATISFIABLE = 416;
    public const EXPECTATION_FAILED = 417;
    public const IM_A_TEAPOT = 418;
    public const MISDIRECTED_REQUEST = 421;
    public const UNPROCESSABLE_ENTITY = 422;
    public const LOCKED = 423;
    public const FAILED_DEPENDENCY = 424;
    public const UPGRADE_REQUIRE = 426;
    public const PRECONDITION_REQUIRED = 428;
    public const TOO_MANY_REQUESTS = 429;
    public const REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    public const LOGIN_TIMEOUT = 440;
    public const NO_RESPONSE = 444;
    public const UNAVAILABLE_FOR_LEGAL_REASONS = 451;
    public const REQUEST_HEADER_TOO_LARGE = 494;
    public const SSL_CERTIFICATE_ERROR = 495;
    public const SSL_CERTIFICATE_REQUIRED = 496;
    public const HTTP_REQUEST_SENT_TO_HTTPS_PORT = 497;
    public const CLIENT_CLOSED_REQUEST = 499;

    public const INTERNAL_SERVER_ERROR = 500;
    public const NOT_IMPLEMENTED = 501;
    public const BAD_GATEWAY = 502;
    public const SERVICE_UNAVAILABLE = 503;
    public const GATEWAY_TIMEOUT = 504;
    public const HTTP_VERSION_NOT_SUPPORTED = 505;
    public const VARIANT_ALSO_NEGOTIATES = 506;
    public const INSUFFICIENT_STORAGE = 507;
    public const LOOP_DETECTED = 508;
    public const NOT_EXTENDED = 510;
    public const NETWORK_AUTHENTICATION_REQUIRED = 511;

    /**
     * @var array
     */
    private static $messages = [
        self::CONTINUE => 'Continue',
        self::SWITCHING_PROTOCOLS => 'Switching protocols',
        self::PROCESSING => 'Processing',
        self::EARLY_HINTS => 'Early hints',
        self::OK => 'OK',
        self::CREATED => 'Created',
        self::ACCEPTED => 'Accepted',
        self::NONAUTHORITATIVE_INFORMATION => 'Non-authoritative information',
        self::NO_CONTENT => 'No content',
        self::RESET_CONTENT => 'Reset content',
        self::PARTIAL_CONTENT => 'Partial content',
        self::MULTI_STATUS => 'Multi status',
        self::ALREADY_REPORTED => 'Already reported',
        self::IM_USED => 'IM used',
        self::MULTIPLE_CHOICES => 'Multiple choices',
        self::MOVED_PERMANENTLY => 'Moved permanently',
        self::FOUND => 'Found',
        self::SEE_OTHER => 'See other',
        self::NOT_MODIFIED => 'Not modified',
        self::USE_PROXY => 'Use proxy',
        self::SWITCH_PROXY => 'Switch proxy',
        self::TEMPORARY_REDIRECT => 'Temporary redirect',
        self::PERMANENT_REDIRECT => 'Permanent redirect',
        self::BAD_REQUEST => 'Bad request',
        self::UNAUTHORIZED => 'Unauthorized',
        self::PAYMENT_REQUIRED => 'Payment required',
        self::FORBIDDEN => 'Forbidden',
        self::NOT_FOUND => 'Not found',
        self::METHOD_NOT_ALLOWED => 'Method not allowed',
        self::NOT_ACCEPTABLE => 'Not acceptable',
        self::PROXY_AUTHENTICATION_REQUIRED => 'Proxy authentication required',
        self::REQUEST_TIMEOUT => 'Request timeout',
        self::CONFLICT => 'Conflict',
        self::GONE => 'Gone',
        self::LENGTH_REQUIRED => 'Length required',
        self::PRECONDITION_FAILED => 'Precondition failed',
        self::PAYLOAD_TOO_LARGE => 'Payload too large',
        self::URI_TOO_LONG => 'URI too long',
        self::UNSUPPORTED_MEDIA_TYPE => 'Unsupported media type',
        self::RANGE_NOT_SATISFIABLE => 'Range not satisfiable',
        self::EXPECTATION_FAILED => 'Expectation failed',
        self::IM_A_TEAPOT => 'I\'m a teapot',
        self::MISDIRECTED_REQUEST => 'Misdirected request',
        self::UNPROCESSABLE_ENTITY => 'Unprocessable entity',
        self::LOCKED => 'Locked',
        self::FAILED_DEPENDENCY => 'Failed dependency',
        self::UPGRADE_REQUIRE => 'Upgrade require',
        self::PRECONDITION_REQUIRED => 'Precondition required',
        self::TOO_MANY_REQUESTS => 'Too many requests',
        self::REQUEST_HEADER_FIELDS_TOO_LARGE => 'Request header fields too large',
        self::LOGIN_TIMEOUT => 'Login timeout',
        self::NO_RESPONSE => 'No response',
        self::UNAVAILABLE_FOR_LEGAL_REASONS => 'Unavailable for legal reasons',
        self::REQUEST_HEADER_TOO_LARGE => 'Request header too large',
        self::SSL_CERTIFICATE_ERROR => 'SSL certificate error',
        self::SSL_CERTIFICATE_REQUIRED => 'SSL certificate required',
        self::HTTP_REQUEST_SENT_TO_HTTPS_PORT => 'HTTP request sent to HTTPS port',
        self::CLIENT_CLOSED_REQUEST => 'Client closed request',
        self::INTERNAL_SERVER_ERROR => 'Internal server error',
        self::NOT_IMPLEMENTED => 'Not implemented',
        self::BAD_GATEWAY => 'Bad gateway',
        self::SERVICE_UNAVAILABLE => 'Service unavailable',
        self::GATEWAY_TIMEOUT => 'Gateway timeout',
        self::HTTP_VERSION_NOT_SUPPORTED => 'HTTP version not supported',
        self::VARIANT_ALSO_NEGOTIATES => 'Variant also negotiates',
        self::INSUFFICIENT_STORAGE => 'Insufficient storage',
        self::LOOP_DETECTED => 'Loop detected',
        self::NOT_EXTENDED => 'Not extended',
        self::NETWORK_AUTHENTICATION_REQUIRED => 'Network authentication required',
    ];

    /**
     * @param int $code
     *
     * @return string
     */
    public static function getMessage(int $code): string
    {
        return static::$messages[$code] ?? 'Unknown status code';
    }
}
