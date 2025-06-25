# Pen_test
Penetration testing with Credential stuffing.  


# Credential Stuffing Prevention Cheat Sheet

## Introduction

In partial fufilment for my course of work in Mohawk college; Secure software development requires  safe design and implementation of softwares. Let's evaluate with  three common types of authentication-related attacks: credential stuffing , password spraying and brute-force attacks.  In Summary:

| Attack Type | Description |
|-------------|-------------|
| Brute Force | Testing multiple passwords from dictionary or other source against a single account. |
| Credential Stuffing | Testing username/password pairs obtained from the breach of another site. |
| Password Spraying | Testing a single weak password against a large number of different accounts.|

## Multi-Factor Authentication

[Multi-factor authentication (MFA)] Multi-factor authentication (MFA) is the best defense against password-related attacks, including credential stuffing and password spraying. With modern browsers and mobile devices supporting FIDO2 Passkeys, it is attainable for most use cases. MFA can be combined with other techniques to require the second factor only in specific circumstances, such as a new browser/device or IP address, unusual country or location, untrusted countries, known denylists or anonymization services, multiple account logins, or scripted login attempts. Organizations can also require MFA as a "step-up" authentication during high-risk activities.

## Alternative Defenses

In situations where MFA is not feasible, alternative defenses like multiple layered defenses can provide adequate protection against credential stuffing and password spraying. These mechanisms can also protect against brute-force or password spraying attacks. Different defenses may be appropriate for different user roles.

## Defense in Depth & Metrics

Implementing defenses that consider individual defeats, client-side defenses, and volume metrics is crucial. Monitor and report metrics, ensure communication, and coordinate multiple teams.

### Secondary Passwords, PINs and Security Questions

As well as requiring a user to enter their password when authenticating, users can also be prompted to provide additional security information such as:

- A PIN
- Specific characters from a secondary passwords or memorable word
- Answers to Security Questions.
It must be emphasised that this **does not** constitute multi-factor authentication (as both factors are the same - something you know).

### CAPTCHA

CAPTCHAs can help identify automated attacks and prevent login attempts, slowing down credential stuffing or password spraying attacks. Monitoring CAPTCHA solve rates can identify potential impact on users and automated CAPTCHA breaking technology, potentially indicating abnormally high solve rates.

### IP Mitigation and Intelligence

Blocking IP addresses is a defense against less sophisticated attacks, but it should not be the only solution. A graduated response should consider various abuse scenarios, IP address classification, and geolocation. Temporary mitigations and processes should be in place to remove IP addresses as abuse declines. Proxy networks and hosting provider IP address ranges can help identify attacks.

### Require JavaScript and Block Headless Browsers

Tools for these attacks make direct POST requests to servers, but do not execute JavaScript. To execute JavaScript, attackers must evaluate it in the response, using automation frameworks like Selenium or Headless Chrome or JavaScript parsing tools like PhantomJS.


### Notify users about unusual security events

Users should be notified of suspicious activity, warned about email account compromise, and prompted to change passwords if successful. Multiple password resets should be prevented, and login details should be visible.

