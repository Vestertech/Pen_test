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

Where it is not possible to implement MFA, there are many alternative defenses that can be used to protect against credential stuffing and password spraying. In isolation none of these are as effective as MFA, however multiple, layered defenses can provide a reasonable degree of protection. In many cases, these mechanisms will also protect against brute-force or password spraying attacks.

Where an application has multiple user roles, it may be appropriate to implement different defenses for different roles. For example, it may not be feasible to enforce MFA for all users, but it should be possible to require that all administrators use it.

## Defense in Depth & Metrics

Implementing defenses that consider the impact of individual defenses being defeated or failing is crucial. Consider client-side defenses like device fingerprinting and JavaScript challenges. Generate volume metrics for detective purposes, including detected and mitigated attack volume. Monitor and report metrics to identify defense failures and impact of new or improved defenses. Ensure communication and coordination between multiple teams.
### Secondary Passwords, PINs and Security Questions

As well as requiring a user to enter their password when authenticating, users can also be prompted to provide additional security information such as:

- A PIN
- Specific characters from a secondary passwords or memorable word
- Answers to Security Questions.
It must be emphasised that this **does not** constitute multi-factor authentication (as both factors are the same - something you know). However, it can still provide a useful layer of protection against both credential stuffing and password spraying where proper MFA can't be implemented.

### CAPTCHA

Requiring a user to solve a "Completely Automated Public Turing test to tell Computers and Humans Apart" (CAPTCHA) or similar puzzle for each login attempt can help to identify automated/bot attacks and help prevent automated login attempts, and may slow down credential stuffing or password spraying attacks.  However, CAPTCHAs are not perfect, and in many cases tools or services exist that can be used to break them with a reasonably high success rate.  Monitoring CAPTCHA solve rates may help identify impact to good users, as well as automated CAPTCHA breaking technology, possibly indicated by abnormally high solve rates.

To improve usability, it may be desirable to only require the user solve a CAPTCHA when the login request is considered suspicious or high risk, using the same criteria discussed in the MFA section.

### IP Mitigation and Intelligence

Blocking IP addresses is a useful defense against less sophisticated attacks, but it should not be the sole solution. A graduated response to abuse should consider various abuse scenarios, including short and long time periods, high request volume, and instances where one IP address generates low but consistent traffic volumes. Factors such as IP address classification and geolocation should be considered. Mitigations should be temporary and processes should be in place to remove an IP address from a mitigated state as abuse declines. Proxy networks and hosting provider IP address ranges can help identify highly distributed attacks and trigger mitigation. Public and commercial sources of IP address intelligence and classification can be used.

Using these various attributes, it is possible to create a fingerprint of the device. This fingerprint can then be matched against any browser attempting to login to the account, and if it doesn't match then the user can be prompted for additional authentication. Many users will have multiple devices or browsers that they use, so it is not practical to simply block attempts that do not match the existing fingerprints, however it is common to define a process for users or customers to view their device history and manage their remembered devices.  Also these attributes can be used to detect anomalous activity such as a device appearing to be running an older version of OS or Browser.

It should be noted that as all this information is provided by the client, it can potentially be spoofed by an attacker. In some cases spoofing these attributes is trivial (such as the "User-Agent") header, but in other cases it may be more difficult to modify these attributes.




### Require JavaScript and Block Headless Browsers

Most tools used for these types of attacks will make direct POST requests to the server and read the responses, but will not download or execute JavaScript that was contained in them. By requiring the attacker to evaluate JavaScript in the response (for example to generate a valid token that must be submitted with the request), this forces the attacker to either use a real browser with an automation framework like Selenium or Headless Chrome, or to implement JavaScript parsing with another tool such as PhantomJS.




### Notify users about unusual security events

When suspicious activity is detected, users should be notified or warned, but not overwhelmed with unnecessary notifications. The possibility of email account compromise is also considered. Notifying users of incorrect password attempts is generally not appropriate, but if successful, they should be notified to change their password. If multiple password resets are requested, users should be prevented from accessing the account. Details about current or recent logins should be visible, and concurrent sessions should be managed.

