/*
Template belongs to : Himanshu Jaju [himanshujaju]
*/

#include<bits/stdc++.h>
using namespace std;

typedef long long int LL;

#define inp_s ios_base::sync_with_stdio(false);

#define VI vector<int>
#define VS vector<string>
#define VLL vector<LL>
#define PII pair<int,int>

#define all(c) c.begin(),c.end()
#define sz(c) c.size()
#define clr(c) c.clear()

#define msi  map<string,int>
#define msit map<string,int>::iterator

#define pb push_back
#define mp make_pair

#define FOR(i,a,b) for(int i=a;i<b;i++)

int hash[1001] = {0};

int main()
{
      inp_s;
      while(true)
      {
          for(int i=0;i<=1000000;i++) hash[i] = 0;
            int n;
            cin>>n;
            if(!n) return 0;
            int arr[n];
            for(int i=0;i<n;i++)
            {
                  cin>>arr[i];
                  hash[arr[i]]++;
            }
            for(int i=1000000-1;i>=0;i--)
            {
                  arr[i] += arr[i-1];
            }
            sort(arr,arr+n);
            int ans = 0;
            for(int i=0;i<n;i++)
            {
                  for(int j=i+1;j<n;j++)
                  {
                        int sum = arr[i]+arr[j];
                        if(sum<=1000000) ans += hash[sum];
                  }
            }
            cout<<ans<<endl;
      }
      return 0;
}
