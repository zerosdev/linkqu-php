<?php

declare(strict_types=1);

namespace ZerosDev\LinkQu;

use DateTime;
use DateTimeZone;
use Exception;
use ZerosDev\LinkQu\Exceptions\SendableException;

class Report extends Base
{
    /**
     * HTTP Requestor client.
     *
     * @var Client
     */
    protected $client;

    /**
     * Constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Cek status transaksi.
     * Digunakan untuk pengecekan transaksi pembayaran setelah pembayaran.
     *
     * @return \stdClass|false
     */
    public function status(string $partnerRef)
    {
        $endpoint = 'linkqu-partner/transaction/payment/checkstatus';
        $params = [
            'username' => $this->client->username(),
            'partnerreff' => (string) $partnerRef,
        ];

        return $this->client->get($endpoint, $params);
    }

    /**
     * Cek status transaksi virtual account.
     * Digunakan untuk pengecekan transaksi pembayaran virtual account setelah pembayaran.
     *
     * @return \stdClass|false
     */
    public function statusVA(string $partnerRef)
    {
        $endpoint = 'linkqu-partner/transaction/payment/va/checkstatus';
        $params = [
            'username' => $this->client->username(),
            'partnerreff' => (string) $partnerRef,
        ];

        return $this->client->get($endpoint, $params);
    }

    /**
     * Report Transaction.
     * Digunakan untuk pengecekan laporan transaksi berdasarkan range tanggal tertentu.
     *
     * @param string $startDate
     * @param string $endDate
     * @param int    $limit
     * @param int    $offset
     *
     * @return \stdClass|false
     */
    public function reports(string $startDate, string $endDate, int $limit = 10, int $offset = 0)
    {
        $offset = ($offset < 0) ? 0 : $offset;
        $limit = ($limit < 0) ? 10 : $limit;

        $startDate = DateTime::createFromFormat('Y-m-d', $startDate)
            ->setTimezone(new DateTimeZone('Asia/Jakarta'));
        $errors = DateTime::getLastErrors();

        if (($errors['warning_count'] + $errors['error_count']) > 0) {
            $this->client->addError('Invalid date format supplied for startDate. Please use YYYY-MM-DD format.', false);
            return false;
        }

        $endDate = DateTime::createFromFormat('Y-m-d', $endDate)
            ->setTimezone(new DateTimeZone('Asia/Jakarta'));
        $errors = DateTime::getLastErrors();

        if (($errors['warning_count'] + $errors['error_count']) > 0) {
            $this->client->addError('Invalid date format supplied for endDate. Please use YYYY-MM-DD format.', false);
            return false;
        }

        $endpoint = 'linkqu-partner/transaction/payment/report';
        $params = [
            'username' => $this->client->username(),
            'offset' => $offset,
            'limit' => $limit,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
        ];

        return $this->client->get($endpoint, $params);
    }
}
