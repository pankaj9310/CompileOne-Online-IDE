arr = list()
N,P,K = map(int, raw_input().split(' '))
arr=map(int,raw_input().split())
arr.sort()
arr1 = [0]*N;
cnt = 0
print arr
print arr1
for i in range(1,N-1):
    if((int(arr[i-1])-int(arr[i]))<= K):
        cnt = cnt+1
        arr1.append(cnt)
print arr1
while(P>0):
    A,B = map(int,raw_input().split(' '))
    P = P-1
    if((int(arr1[B])-int(arr1[A])) == (B-A)):
        print "Yes"
    else:
        print "No"