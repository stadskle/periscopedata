<?php
namespace Stadskle\PeriscopeData;

/**
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED.
 * IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
/**
 * Class to create embeded URLs to use with periscopedata.com
 *
 * @link https://doc.periscopedata.com/docv2/embed-api
 * @license https://opensource.org/licenses/MIT
 */
class EmbedUrl
{

    /**
     *
     * @var string
     */
    protected $apiKey;

    /**
     *
     * @var array
     */
    protected $options;

    const PATH = '/api/embedded_dashboard';

    const URL = 'https://www.periscopedata.com';

    public function __construct($apiKey, array $options = [])
    {
        $this->apiKey = $apiKey;
        $this->options = $options;
    }

    public function getSignature()
    {
        return hash_hmac('sha256', self::PATH . '?data=' . $this->getEncodedData(), $this->apiKey);
    }

    public function getEncodedData()
    {
        return urlencode(json_encode($this->options));
    }

    public function getLink()
    {
        return sprintf(self::URL . self::PATH . '?data=%s&signature=%s', $this->getEncodedData(), $this->getSignature());
    }
}